<?php

namespace App\Http\Requests\UsuarioEdil;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $validate = [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'identificacion' => ['required', 'string', 'min:8', 'max:15', 'unique:usuarios_ediles,identificacion,'. $this->id ?? 'NULL'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios_ediles,email,'. $this->id ?? 'NULL'],
            'genero' => ['required', 'string', 'in:Hombre,Mujer,Otro'],
            'tipo_zona' => ['required', 'in:Corregimiento,Comuna'],
            'zona' => ['required'],
            'puesto_votacion' => ['required'],
            'foto' => ['image', 'nullable'],
        ];

        return $validate;
    }
}
