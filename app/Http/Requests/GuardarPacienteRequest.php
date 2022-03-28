<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarPacienteRequest extends FormRequest
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
            'nombre' => 'required',
            'apellido' => 'required',
            'CI' => 'required|numeric|unique:pacientes,CI',
            'sexo' => 'required',
            'tipo_sangre' => 'required',
            'telefono' => 'required|numeric',
            'correo' => 'required',
            'direccion' => 'required'

        ];
    }
}
