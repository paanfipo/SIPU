<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Actualizar Practica 
 * 
 * Clase que se encarga de validar los datos de las ciudades que se registran.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Ciudades
 */
class CiudadRequest extends FormRequest
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
            'nombre' => 'required|unique:ciudades',
            'codigo_dane' => 'required|unique:ciudades',
            'observacion' => 'required',
            'departamento_id' => 'required',
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
            'departamento_id'                     => 'Pais',
            'estado'                   => 'Estado'
        ];
    }
}
