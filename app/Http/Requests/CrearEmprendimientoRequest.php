<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Emprendimiento 
 * 
 * Clase que se encarga de validar los datos de los emprendimientos que se registran.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimiento 
 */
class CrearEmprendimientoRequest extends FormRequest
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
        ];
    }
}
