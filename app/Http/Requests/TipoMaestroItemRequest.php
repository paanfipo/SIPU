<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Tipo Maestro Item
 * 
 * Clase que se encarga de validar los datos items de los tipos maestros que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Tipo Maestro Item
 */
class TipoMaestroItemRequest extends FormRequest
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
            'nombre' => 'required',
            'numitem' => 'required',
            'observacion' => 'required',
            'tipomaestro_id' => 'required',
            'estado' => 'required'

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
            'nombre'                   => 'Nombre',
            'numitem' => 'Numero Item',
            'observacion'  => 'Observación',
            'tipomaestro_id' => 'Tipo Maestro',
            'estado' => 'Estado'
        ];
    }
}
