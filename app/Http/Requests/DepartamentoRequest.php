<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Departamento 
 * 
 * Clase que se encarga de validar los datos de los departamentos que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Departamentos
 */
class DepartamentoRequest extends FormRequest
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
            'nombre' => 'required|unique:departamentos',
            'codigo_dane' => 'required|unique:departamentos',
            'observacion' => 'required',
            'pais_id' => 'required',
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
            'codigo_dane'             => 'Codigo Dane',
            'observacion'                => 'Observación',
            'pais'                     => 'Pais',
            'estado'                   => 'Estado'
        ];
    }
}
