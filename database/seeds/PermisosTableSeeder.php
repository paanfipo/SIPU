<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Modulo;


class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*****PAQUETE CONFIG****/

        //Roles
        $modulo = Modulo::where('name','Roles')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Rol',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Rol',
                'guard_name' => 'web',
                'modulo_id' =>  $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Roles',
                'guard_name' => 'web',
                'modulo_id' =>  $modulo[0]->id
            ]);


        }

        //Paquetes
        $modulo = Modulo::where('name','Paquetes')->get();
        if(count($modulo) > 0){

            DB::table('permissions')->insert([
                'name' => 'Crear Paquete',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Paquete',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Paquetes',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }




        //Modulos
        $modulo = Modulo::where('name','Modulos')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Modulo',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Modulo',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Modulos',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }


        //Permisos
        $modulo = Modulo::where('name','Permisos')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Permiso',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Permiso',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Permisos',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }


        /*****PAQUETE BÁSICOS****/

        //Tipo Maestro
        $modulo = Modulo::where('name','Maestro e Items')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Tipo Maestro',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Tipo Maestro',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Tipo Maestro',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Tipo Maestro Item
        //$modulo = Modulo::where('name','Tipo Maestro Item')->get();
        "if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Tipo Maestro Item',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Tipo Maestro Item',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Tipo Maestro Item',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }";


        //Paises
        $modulo = Modulo::where('name','Paises')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Pais',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Pais',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Paises',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Depeartamentos
        $modulo = Modulo::where('name','Departamentos')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Departamento',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Departamento',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Departamentos',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Ciudades
        $modulo = Modulo::where('name','Ciudades')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Ciudad',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Ciudad',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Ciudad',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Usuario
        $modulo = Modulo::where('name','Usuario')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Usuario',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Usuario',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Usuarios',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Usuario',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            //Permisos Emprendimiento
            DB::table('permissions')->insert([
                'name' => 'Crear Emprendimiento',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Emprendimiento',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Emprendimiento',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Curriculum',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
            
        }


        //Convocatoria
        $modulo = Modulo::where('name','Convocatorias')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Convocatorias',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Registrarse en la convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Avance convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Registro masivo convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Link registro publico',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Reporte Convocatoria',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Etapas
        $modulo = Modulo::where('name','Etapas')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Etapa',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Etapa',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Etapas',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Etapa',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }


        //Carreras
        $modulo = Modulo::where('name','Carreras')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Carrera',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Carrera',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Carreras',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Carrera',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Dependencias
        $modulo = Modulo::where('name','Dependencias')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Dependencia',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Dependencia',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Dependencias',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Dependencia',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }


        //Actividades
        $modulo = Modulo::where('name','Actividades')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Actividad',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Actividad',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Actividades',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Actividad',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

         //Cronogramas
         $modulo = Modulo::where('name','Cronogramas')->get();
         if(count($modulo) > 0){
             DB::table('permissions')->insert([
                 'name' => 'Crear Cronograma',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
 
             DB::table('permissions')->insert([
                 'name' => 'Actualizar Cronograma',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
 
             DB::table('permissions')->insert([
                 'name' => 'Listar Cronograma',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
 
             DB::table('permissions')->insert([
                 'name' => 'Detalle Cronograma',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
         }


         //Cronogramas
         $modulo = Modulo::where('name','Asistencia')->get();
         if(count($modulo) > 0){
             DB::table('permissions')->insert([
                 'name' => 'Crear Asistencia',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
 
             DB::table('permissions')->insert([
                 'name' => 'Actualizar Asistencia',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
 
             DB::table('permissions')->insert([
                 'name' => 'Listar Asistencia',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
 
             DB::table('permissions')->insert([
                 'name' => 'Detalle Asistencia',
                 'guard_name' => 'web',
                 'modulo_id' => $modulo[0]->id
             ]);
         }

          //Ofertas
        $modulo = Modulo::where('name','Ofertas')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Oferta',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
         

            DB::table('permissions')->insert([
                'name' => 'Actualizar Oferta',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Oferta',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Oferta',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Postular Oferta',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Retirar Oferta',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Gestiones
        $modulo = Modulo::where('name','Gestiones')->get();
        if(count($modulo) > 0){
           DB::table('permissions')->insert([
               'name' => 'Listar Gestiones',
               'guard_name' => 'web',
               'modulo_id' => $modulo[0]->id
           ]);

           DB::table('permissions')->insert([
            'name' => 'Solicitudes',
            'guard_name' => 'web',
            'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Novedades',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Documentacion',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        $modulo = Modulo::where('name','Trámites')->get();

        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Listar Trámites',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Oferta a Tramite',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Admitir Postulación',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);               

            DB::table('permissions')->insert([
                'name' => 'Rechazar Postulación',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        //Salones
        $modulo = Modulo::where('name','Salones')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Salones',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Actualizar Salones',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Listar Salones',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);

            DB::table('permissions')->insert([
                'name' => 'Detalle Salones',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        /* permisos para programacion academica */
         //Salones
        $modulo = Modulo::where('name','Programas')->get();
        if(count($modulo) > 0){
            DB::table('permissions')->insert([
                'name' => 'Crear Programas',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
 
            DB::table('permissions')->insert([
                'name' => 'Actualizar Programas',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
 
            DB::table('permissions')->insert([
                'name' => 'Listar Programas',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
 
            DB::table('permissions')->insert([
                'name' => 'Detalle Programas',
                'guard_name' => 'web',
                'modulo_id' => $modulo[0]->id
            ]);
        }

        $permisos = Permission::all()->toArray();
        $permisos_array_name = array_column($permisos, 'name');

        $permision_rol_general = [
                                    'Actualizar Usuario',
                                    'Crear Emprendimiento',
                                    'Actualizar Emprendimiento',
                                    'Listar Emprendimiento',
                                    'Listar Convocatorias',
                                    'Detalle Convocatoria',
                                    'Registrarse en la convocatoria',
                                    //'Avance convocatoria',
                                    'Listar Gestiones',
                                    'Novedades',
                                    'Solicitudes',
                                    'Listar Oferta',
                                    'Detalle Oferta',
                                    'Postular Oferta',
                                    'Retirar Oferta',
                                    'Curriculum',
                                ];

        $permision_rol_asesor = [
                                    'Actualizar Usuario',
                                    'Crear Emprendimiento',
                                    'Actualizar Emprendimiento',
                                    'Listar Emprendimiento',
                                    'Listar Gestiones',
                                    'Novedades', //Novedades en preincubación y aceleración
                                    'Solicitudes', //Sin implementar
                                    'Documentacion',
                                    'Listar Convocatorias',
                                    'Avance convocatoria',
                                    'Link registro publico'
        ];

        $permision_rol_estudiante = [
                                    'Actualizar Emprendimiento',                                    
                                    'Listar Emprendimiento',
                                    'Listar Convocatorias',
                                    'Detalle Convocatoria',
                                    'Registrarse en la convocatoria',
                                    'Listar Gestiones',
                                    'Novedades',
                                    'Solicitudes',

                                    'Actualizar Usuario',
                                    'Listar Oferta',
                                    'Detalle Oferta',
                                    'Postular Oferta',
                                    'Retirar Oferta',
                                    'Curriculum',
        ];

        $permision_rol_proyeccion_social = [
                                            'Actualizar Usuario',
                                            'Listar Oferta',
                                            'Detalle Oferta',
                                            'Crear Oferta',
                                            'Actualizar Oferta',
        ];

        $permision_rol_coordinador_practicas = [
                                                'Actualizar Usuario',
                                                'Crear Oferta',
                                                'Listar Oferta',
                                                'Detalle Oferta',
                                                'Actualizar Oferta',
        ];

        $permision_rol_empresa = [
                                'Actualizar Usuario',
                                'Crear Oferta',
                                'Listar Oferta',
                                'Detalle Oferta',
                                'Actualizar Oferta',
                                'Listar Trámites',
                                'Detalle Oferta a Tramite',
                                'Admitir Postulación',
                                'Rechazar Postulación',
                                'Rechazar Postulación',
                                'Detalle Usuario'
        ];

        $permision_rol_dependencia = [
                                'Actualizar Usuario',
                                'Crear Oferta',
                                'Listar Oferta',
                                'Detalle Oferta',
                                'Actualizar Oferta',
        ];

        $permision_rol_coordinador_emprendimiento = [
                                'Actualizar Usuario',
                                'Crear Emprendimiento',
                                'Actualizar Emprendimiento',
                                'Listar Emprendimiento',
                                'Crear Convocatoria',
                                'Actualizar Convocatoria',
                                'Listar Convocatorias',
                                'Detalle Convocatoria',
                                'Registrarse en la convocatoria',
                                'Avance convocatoria',
                                'Reporte Convocatoria',
                                'Registro masivo convocatoria',
                                'Link registro publico',
                                'Crear Etapa',
                                'Actualizar Etapa',
                                'Listar Etapas',
                                'Detalle Etapa',
                                'Crear Carrera',
                                'Actualizar Carrera',
                                'Listar Carreras',
                                'Detalle Carrera',
                                'Crear Dependencia',
                                'Actualizar Dependencia',
                                'Listar Dependencias',
                                'Detalle Dependencia',
                                'Crear Actividad',
                                'Actualizar Actividad',
                                'Listar Actividades',
                                'Detalle Actividad',
                                'Crear Cronograma',
                                'Actualizar Cronograma',
                                'Listar Cronograma',
                                'Detalle Cronograma',
                                'Crear Asistencia',
                                'Actualizar Asistencia',
                                'Listar Asistencia',
                                'Detalle Asistencia',
                                'Crear Oferta',
                                'Actualizar Oferta',
                                'Listar Oferta',
                                'Detalle Oferta',
                                'Postular Oferta',
                                'Retirar Oferta',
                                'Listar Gestiones',
                                'Solicitudes',
                                'Novedades',
                                'Documentacion',
                                'Curriculum'
        ];

        $permisos_rol_director_programa = [
                'Actualizar Usuario',
                'Crear Oferta',
                'Listar Oferta',
                'Detalle Oferta',
                'Actualizar Oferta',
                'Listar Trámites',
                'Detalle Oferta a Tramite',
                'Admitir Postulación',
                'Rechazar Postulación',
                'Detalle Usuario',
                'Curriculum'
        ];

        $permisos_rol_profesor_apoyo = [
            'Actualizar Usuario',
            'Crear Oferta',
            'Listar Oferta',
            'Detalle Oferta',
            'Actualizar Oferta',
            'Listar Trámites',
            'Detalle Oferta a Tramite',
            'Admitir Postulación',
            'Rechazar Postulación',
            'Detalle Usuario',
            'Curriculum'
    ];


        $role = Role::findByName('Administrador');
        $role->givePermissionTo($permisos_array_name);

        $role_general = Role::findByName('General');
        $role_general->givePermissionTo($permision_rol_general);

        $role_asesor = Role::findByName('Asesor');
        $role_asesor->givePermissionTo($permision_rol_asesor);

        $role_estudiante = Role::findByName('Estudiante');
        $role_estudiante->givePermissionTo($permision_rol_estudiante);

        $role_coordinador_emprendimiento = Role::findByName('Coordinador de emprendimiento');
        $role_coordinador_emprendimiento->givePermissionTo($permision_rol_coordinador_emprendimiento);

        $role_proyeccion_social = Role::findByName('Coordinador proyeccion social');
        $role_proyeccion_social->givePermissionTo($permision_rol_proyeccion_social);

        $role_coordinador_practicas = Role::findByName('Coordinador de practicas');
        $role_coordinador_practicas->givePermissionTo($permision_rol_coordinador_practicas);

        $role_empresa = Role::findByName('Empresa');
        $role_empresa->givePermissionTo($permision_rol_empresa);

        $role_director = Role::findByName('Director de programa');
        $role_director->givePermissionTo($permisos_rol_director_programa);

        $role_profesor_apoyo = Role::findByName('Profesor de apoyo');
        $role_profesor_apoyo->givePermissionTo($permisos_rol_profesor_apoyo);

    }
}
