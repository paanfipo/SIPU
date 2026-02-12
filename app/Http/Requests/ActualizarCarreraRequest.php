<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Actualizar Carrera 
 * 
 * Clase que se encarga de validar la información de las actividades cuando se actualiza.
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Basico
 * @subpackage Carrera
 */
class ActualizarCarreraRequest extends FormRequest
{
    /**
     * Determine si el usuario está autorizado para realizar esta solicitud.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenga las reglas de validación que se aplican a la solicitud.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => 'required|unique:carreras',
            'nombre' => 'required',
            'email' => 'required',
        ];
    }

    /**
     * Formatea los nombres de los campos para la previsualización de los mensajes de alerta.
     * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
     * @return array
     */
    public function attributes()
    {
        return [
            'codigo' => 'Código de la carrera',
            'nombre' => 'Nombre de la carrera',
            'email' => 'Email de la carrera',

        ];
    }
}
