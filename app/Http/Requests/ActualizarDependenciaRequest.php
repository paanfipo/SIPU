<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Actualizar Dependencia 
 * 
 * Clase que se encarga de validar la información de las dependencias cuando se actualiza.
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Basico
 * @subpackage Dependencia
 */
class ActualizarDependenciaRequest extends FormRequest
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
            'codigo' => 'required|unique:dependencias|max:4',
            'nombre' => 'required',
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
            'codigo' => 'Codigo dependencia',
            'nombre' => 'Nombre dependencia',
        ];
    }
}
