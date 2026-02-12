<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Postular Estudiantes 
 * 
 * Clase que se encarga de validar los datos de solicitados en el momento que el estudiante se postula en una monitoria.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Vacantes
 * @subpackage Ofertas
 */
class PostularEstudiante extends FormRequest
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
            'cedula' => 'required|mimes:pdf,xlx,csv|max:2048',
            'tabulado' => 'required|mimes:pdf,xlx,csv|max:2048',
            'confidencialidad' => 'mimes:pdf,xlx,csv|max:2048',
            'recibo_pago' => 'mimes:pdf,xlx,csv|max:2048',
            'certificacion_bancaria' => 'required|mimes:pdf,xlx,csv|max:2048',
        ];
    }
}
