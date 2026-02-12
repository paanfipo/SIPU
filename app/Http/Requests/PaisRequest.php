<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Pais 
 * 
 * Clase que se encarga de validar los datos de los paises que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Paises
 */
class PaisRequest extends FormRequest
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
            'codigo_dane' => 'required|unique:paises',
            'codigo_iso' => 'required|unique:paises',
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
            'codigo_iso'                => 'Codigo Iso',
            'estado'                   => 'Estado'
        ];
    }
}
