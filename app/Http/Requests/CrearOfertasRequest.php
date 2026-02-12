<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Crear Vacante Laboral 
 * 
 * Clase que se encarga de validar los datos de la vacante laboral que se registra.
 * 
 * @author Lenin Carabali <lenin.carabali@correounivalle.edu.co>
 * @package Vacante
 * @subpackage Laboral
 */
class CrearOfertasRequest extends FormRequest
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
            'nombre_empresa_dependencia' => 'required',
            'nombre_oferta' => 'required',
            'cargo'  => 'required',
            'tipo_oferta' => 'required',
            'salario' => 'required',
            'duracion_meses' => 'required',
            'cantidad' => 'required',
            'fecha_cierre_vacante' => 'required',
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
            'nombre_empresa' => 'Nombre de la empresa o dependencia',
            'nombre_oferta' => 'Nombre de la Oferta',
            'cargo'  => 'Cargo',
            'tipo_oferta' => 'Tipo oferta',
            'salalrio' => 'Salario',
            'duracion_meses' => 'Duracion meses',
            'cantidad' => 'Cantidad',
            'fecha_cierre_vacante' => 'Fecha cierre vacante',

        ];
    }
}
