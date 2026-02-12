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
class LinkRegistroRequest extends FormRequest
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
            'first_name'                   => ['required', 'string', 'max:255'],
            'last_name'             => ['required', 'string', 'max:255'],
            'email'                => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
            'first_name.required' => 'El campo nombres es requerido',
            'last_name.required' => 'El campo apellidos es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe estar en formato email',
            'email.unique' => 'El email ya se encuentra registrado',
            'password.required' => 'El campo password es requerido',
            'password.confirmed' => 'Debe confirmar password',
        ];
    }
}
