<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Import Registro Masivo 
 * 
 * Clase que se encarga de validar los datos del proceso de importacion que se registra.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Emprendimientos
 */
class ImportRegistroMasivoRequest extends FormRequest
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
            'list'  => 'required|mimes:xls,xlsx',
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
            'list' => 'Archivo',
        ];
    }

    /**
     * Formato de mensaje predeterminado a la acciones request que se generar por validación incorrecta
     * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
     * @return array
     */
    public function messages()
    {
        return [
            'list.required' => 'Debe adjuntar el archivo',
            'list.mimes' => 'El archivo debe ser de tipo xls,xlsx',
        ];
    }
}
