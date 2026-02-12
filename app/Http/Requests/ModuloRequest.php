<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Registro Publico 
 * 
 * Clase que se encarga de validar los datos del registro publico en una convocatoria que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos
 */
class ModuloRequest extends FormRequest
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
            'name'                   => 'required|unique:modulos',
            'icon'             => 'required',
            'state'                => 'required',
            //'url'                   => 'required',
            'paquete_id' => 'required',
            'observation' => 'required'
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
            'name'                   => 'Nombre',
            'icon'             => 'Icono',
            'state'                => 'Estado',
            //'url'                   => 'Url',
            'paquete_id' => 'Paquetes',
            'observation' => 'Observcaión'
        ];
    }
}
