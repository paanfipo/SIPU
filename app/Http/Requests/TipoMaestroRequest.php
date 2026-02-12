<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Tipo Maestro 
 * 
 * Clase que se encarga de validar los datos tipos maestros que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Tipo Maestro
 */
class TipoMaestroRequest extends FormRequest
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
            'nombre' => 'required|unique:tipomaestro',
            'observacion' => 'required',
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
            'observacion'  => 'Observación',
            'estado' => 'Estado'
        ];
    }
}
