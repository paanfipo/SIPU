<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Paso Incubación Aceleración 
 * 
 * Clase que se encarga de validar los datos del proceso para pasar de incubación a aceleracion  que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Asistencia
 */
class RequestIncubacionAceleracion extends FormRequest
{
    /**
     * Determine si el usuario está autorizado para realizar esta solicitud.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenga las reglas de validación que se aplican a la solicitud.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
     */
    public function rules()
    {
        return [
            //Usuario
            'departamento_usuario'=> 'required',
            'ciudad_usuario'=> 'required',            
            'direccion_usuario'=> 'required',
            'tipo_zona'=> 'required',

            //Empresa
            'camara_comercio' => 'required',
            'tipo_empresa' => 'required',
            'ruta_emprensarial' => 'required',
            'ruta_modulo' => 'required',
            'ruta_acompañamiento' => 'required',

            
            'convocatoria' => 'required',
            'etapa' => 'required',
            'emprendimiento_id' => 'required',
            'usuario' => 'required',
        ];
    }

    /**
     * Formatea los nombres de los campos para la previsualización de los mensajes de alerta.
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
     */
    public function attributes()
    {
        return [
            //Usuario
            'sexo'=> 'sexo',
        ];
    }
}
