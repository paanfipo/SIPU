<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearSalonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'numero'      => 'required|min:1|unique:salones,numero',
            'capacidad'   => 'required|numeric|min:1',
            'universidad' => 'required',
            'estado'      => 'required',
        ];
    }
}
