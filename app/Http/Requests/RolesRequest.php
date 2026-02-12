<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Roles 
 * 
 * Clase que se encarga de validar los datos de los roles que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Config
 * @subpackage Roles
 */
class RolesRequest extends FormRequest
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
            //
            'name'                   => 'required|unique:roles',
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
        ];
    }
}
