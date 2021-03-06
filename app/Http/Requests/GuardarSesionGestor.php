<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GuardarSesionGestor extends Request
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
            'Fecha' => 'required',
            'Inicio' => 'required',
            'Fin' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Inicio.required' => 'El campo hora inicio es requerido',
            'Fin.required' => 'El campo hora fin es requerido'
        ];
    }
}
