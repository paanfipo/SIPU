<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request Empresa
 * 
 * Clase que se encarga de validar los datos del registro empresa.
 * 
 * @author Vanessa Torres <vanessa.quintero@correounivalle.edu.co>
 * @package Básicos
 * @subpackage Usuario
 */
class CrearEmpresaRequest extends FormRequest
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
            
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required|confirmed',

            'nombre_empresa' => 'required',
            'nit_empresa' => 'required',

            'file_rut' => 'required|mimes:pdf,jpeg,jpg,jpe|max:2048',
            'file_camara_comercio' => 'required|mimes:pdf,jpeg,jpg,jpe|max:2048',
            'file_representante' => 'required|mimes:pdf,jpeg,jpg,jpe|max:2048',
            
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
            'first_name' => 'Nombres',
            'last_name'  => 'Apellidos',            
            'email'      => 'Email',
            'password' => 'Contraseña',
            'nombre_empresa' => 'Nombre Empresa',
            'nit_empresa' => 'NIT Empresa',
            'file_rut' => 'RUT',
            'file_camara_comercio' => 'Camara de comercio',
            'file_representante' => 'Cedula Representante',            

        ];
    }
}
