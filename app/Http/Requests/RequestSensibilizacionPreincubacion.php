<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Paso Sensibilizacion Preincubación 
 * 
 * Clase que se encarga de validar los datos del proceso para pasar de Sensibilización a Preincubación  que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento
 * @subpackage Asistencia
 */
class RequestSensibilizacionPreincubacion extends FormRequest
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
            'sexo'=> 'required',
            'etnia'=> 'required',
            'edad'=> 'required|integer',
            'departamento_usuario'=> 'required',
            'ciudad_usuario'=> 'required',
            'direccion_usuario'=> 'required',
            'nivel_estudio_usuario'=> 'required',
            'tipo_zona'=> 'required',

            //Informacion Emprendimiento
            'nombre_emprendimiento'=> 'required',
            'descripcion_emprendimiento'=> 'required',
            'departamento_empre'=> 'required',
            'ciudad_empre'=> 'required',
            'integrantes_hombres'=> 'required',
            'integrantes_mujeres'=> 'required',
            'sector_economico'=> 'required',
            'producto_servicio'=> 'required',
            'fase_emprendimiento'=> 'required',

            //Modelo de negocio
            'propuesta_valor'=> 'required',
            'relacion_cliente'=> 'required',
            'canal_distribucion'=> 'required',
            'recursos_actuales'=> 'required',
            'inversion_realizada'=> 'required',
            'aliados_actuales'=> 'required',

            //Variable root
            'convocatoria'=> 'required',
            'etapa'=> 'required',
            //'emprendimiento_id'=> 'required',
            'usuario'=> 'required',

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
            'etnia'=> 'etnia',
            'edad'=> 'edad',
            'departamento_usuario'=> 'departamento detalle usuario',
            'ciudad_usuario'=> 'ciudad detalle usuario',
            'direccion_usuario'=> 'direccion detalle usuario',
            'nivel_estudio_usuario'=> 'nivel estudio detalle usuario',
            'tipo_zona'=> 'tipo zona',

            //Informacion Emprendimiento
            'nombre_emprendimiento'=> 'nombre emprendimiento',
            'descripcion_emprendimiento'=> 'descripción emprendimiento',
            'departamento_empre'=> 'departamento detalle emprendimiento',
            'ciudad_empre'=> 'ciudad detalle emprendimiento',
            'integrantes_hombres'=> 'integrantes hombres',
            'integrantes_mujeres'=> 'integrantes mujeres',
            'sector_economico'=> 'sector economico',
            'producto_servicio'=> 'producto servicio',
            'fase_emprendimiento'=> 'fase emprendimiento',

            //Modelo de negocio
            'propuesta_valor'=> 'propuesta valor detalle emprendimiento',
            'relacion_cliente'=> 'relacion cliente detalle emprendimiento',
            'canal_distribucion'=> 'canal distribución detalle emprendimiento',
            'recursos_actuales'=> 'recursos actuales detalle emprendimiento',
            'inversion_realizada'=> 'inversion realizada detalle emprendimiento',
            'aliados_actuales'=> 'aliados actuales detalle emprendimiento',

            //Variable root
            //'convocatoria'=> 'required',
            //'etapa'=> 'required',
            //'emprendimiento_id'=> 'required',
            //'usuario'=> 'required',
        ];
    }
}
