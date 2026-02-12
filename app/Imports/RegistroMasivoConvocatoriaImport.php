<?php

namespace App\Imports;

use App\User;
use App\UserInfo;
use App\Emprendimiento;
use App\Convocatoria;
use App\Asistencia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use DB;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use App\Notifications\Novedades;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNovedades;

class RegistroMasivoConvocatoriaImport implements ToModel, WithBatchInserts, WithHeadingRow,SkipsOnError, WithValidation
{
    use Importable, SkipsErrors;
    public $convocatoria_id = null;
    public function __construct($convocatoria)
    {
        $this->convocatoria_id = $convocatoria;        
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        /*Validator::make($rows->toArray(), [
            '*.email' => 'required',
            '*.nombres_y_apellidos' => 'required',
        ])->validate();              */

        //foreach ($rows as $row) 
        //{
            //Validar si el usuario se encuentra registrado
            $user = User::where('email',$row['email'])->first();
            
            if($user == null){
                //Registrar el usuario
                $user = new User;
                $user->name = $row['nombres_y_apellidos'];
                $user->email = $row['email'];
                $user->password = bcrypt('SIPU');
                $user->state = true;
                $user->user_created_at = \Auth::user()->id;
                $user->save();

                $user->assignRole('General');
            }

            $emprendimiento = $this->registroUserInfo($user,$row);

            //Validar si el usuario ya esta registrado en la convocatoria
            $registros = $user->convocatorias->where('id',$this->convocatoria_id);
            
            if(count($registros) == 0 || $registros == null){
                //Registro del usuario en la convocatoria
                $this->registroConvocatoria($user,$emprendimiento);
                
            }
        //}

        DB::commit();
         
    }

     /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

    public function rules(): array
    {
        return [
             // Above is alias for as it always validates in batches
             'email' => ['required'],
             'nombres_y_apellidos' => ['required']
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'email.required' => 'El email es requerido',
            'nombres_y_apellidos.required' => 'El nombre y apellido es requerido',
        ];
    }

    public function registroConvocatoria($user,$emprendimientoObjec){
        $convocatoria = Convocatoria::find($this->convocatoria_id);
      
        $etapas = $convocatoria->etapas;
        $emprendimiento = ($emprendimientoObjec != null)? $emprendimientoObjec->id : null;
        $sync_data_assig = [];
        $arrayid_actividades = [];
        
        foreach($etapas as $etapa){
            $sync_data_assig[$etapa->id] = [
                                        'emprendimiento' => $emprendimiento,
                                        'finalizado' => false,
                                        'user_id' => $user->id,
                                        ];

            $arrayid_actividades = array_column($etapa->actividades->toArray(),'id');
                                        
            break;             
        }

        $convocatoria->etapaAvance()->attach($sync_data_assig);

        //Regsitro de asistencia de la actividades de la primera etapa de la convocatoria
        $cronogramas =  $convocatoria->cronogramas->whereIn('actividad_id',$arrayid_actividades);

        foreach($cronogramas as $cronograma){

            $asistencia = Asistencia::where('cronograma_id',$cronograma->id)->where('user_id',$user->id)->first();
            if($asistencia == null){
                $asistencia = new Asistencia();
            }
            
            $asistencia->cronograma_id = $cronograma->id;
            $asistencia->user_id = $user->id;
            $asistencia->asistencia = false;
            $asistencia->emprendimiento_id = $emprendimiento;
            $asistencia->user_created_at =\Auth::user()->id;
            $asistencia->user_updated_at = \Auth::user()->id;
            $asistencia->save();

        }

        //Se genera notificación para que el usuario llene el formulario de caracterizacion emprendimiento en la etapa de sensibilización prerequisito para seguir
        $collection = collect([
            "type"=>"Novedades Registro Convocatoria",
            "convocatoria"=> $convocatoria->nombre,
            "convocatoria_id"=> $convocatoria->id,
            "etapa"=> $cronograma->actividad->etapa->nombre,
            "actividad"=>$cronograma->actividad->nombre,
            "cronograma_id"=>$cronograma->id,            
            "cronograma"=>$cronograma->fecha_hora_inicio." ".$cronograma->fecha_hora_fin,            
            "usuario_id" => $user->id,
            "de" => 'SIPU',
            "para" => $user->name,
            "para_email" => $user->email,
            "message"=>'Haga click aca, para llenar el formulario de caracterización del emprendimiento para pasar a la siguiente etapa!',
        ]);

        //Envio a varios usuarios
        
        //if(\Notification::send($user,new Novedades($collection))){
        if($user->notify(new Novedades($collection))){
            $type = "error";
            $mensaje_response = "Comuniquese con soporte!! Error al enviar la notificación";
        }
        
        /*else{
            $mensaje_response = "La novedad fue enviada con exito !!";
            //Envio de correo cuando se genera una notificación
            Mail::to($collection["para_email"])->send(new EmailNovedades($collection));
        }*/

    }

    public function registroUserInfo($user,$row){
        $adicional = array();
        //Registro de información adicional
        $adicional = [
            'ciudad_de_residencia' => $row['ciudad_de_residencia'],
            'estamento' => $row['estamento'],
            'programa_academico_al_que_perteneces_o_tu_perfil_profesional' => $row['programa_academico_al_que_perteneces_o_tu_perfil_profesional'],
            'en_que_area_te_gustaria_recibir_capacitacion_para_fortalecer_tu_proyecto' => $row['en_que_area_te_gustaria_recibir_capacitacion_para_fortalecer_tu_proyecto'],
            'en_que_jornada_te_gustaria_recibir_la_capacitacion' => $row['en_que_jornada_te_gustaria_recibir_la_capacitacion'],
            'sabes_para_que_es_la_unidad_de_emprendimiento' => $row['sabes_para_que_es_la_unidad_de_emprendimiento'],
            'describenos_tu_idea_de_emprendimiento' => $row['describenos_tu_idea_de_emprendimiento'],
            'describenos_tu_idea_o_modelo_de_negocio_clientes_producto_o_serviciopropuesta_de_valor' => $row['describenos_tu_idea_o_modelo_de_negocio_clientes_producto_o_serviciopropuesta_de_valor'],
            'en_que_nivel_esta_tu_proyecto_de_emprendedor' => $row['en_que_nivel_esta_tu_proyecto_de_emprendedor'],
        ];

        if(isset($user->userInfo)){                    
            $user_info_updated = UserInfo::find($user->userInfo->id);
            $user_info_updated->encuesta = json_encode($adicional,JSON_UNESCAPED_UNICODE);                  

            $telefonos = array();
            if($user->userInfo->telefonos != "" || $user->userInfo->telefonos != null){
                $telefonos = json_decode($user->userInfo->telefonos);                        
            }                    
            foreach(explode(",", $row['numero_telefonico']) as $num){
                array_push($telefonos,  $num);
            }
            $user_info_updated->telefonos = json_encode($telefonos);
            $user_info_updated->save();
        }else{                
            $user_info_created = new UserInfo();
            $user_info_created->encuesta = json_encode($adicional,JSON_UNESCAPED_UNICODE);
            $user_info_created->user_id = $user->id;
            $user_info_created->telefonos = json_encode(explode(",", $row['numero_telefonico']));
            $user_info_created->save();
        } 
        
        if($row["describenos_tu_idea_de_emprendimiento"] != "" || $row["describenos_tu_idea_de_emprendimiento"] != null){
            $emprendimiento = new Emprendimiento();
            $emprendimiento->user_id = $user->id;
            $emprendimiento->nombre = $row["describenos_tu_idea_de_emprendimiento"];
            $emprendimiento->descripcion = $row["describenos_tu_idea_de_emprendimiento"];
            //$emprendimiento->modelo_negocio = $row["describenos_tu_idea_o_modelo_de_negocio_clientes_producto_o_serviciopropuesta_de_valor"];
            $emprendimiento->save();

            return $emprendimiento;
        }else{
            return null;
        }
        
    }
}
