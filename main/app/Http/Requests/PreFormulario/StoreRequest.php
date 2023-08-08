<?php

namespace App\Http\Requests\PreFormulario;


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
        /* dd($this->all()); */
        return [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'identificacion' => ['required', 'string', 'min:7', 'max:15'],
            'telefono' => ['required', 'max:255'],
            'direccion' => ['required', 'max:255'],
            'puesto' => ['required'],
            'descripcion' => ['required', 'min:10'],
            'email' => ['nullable', 'email', 'max:255'],
            'genero' => ['required', 'string', 'in:Hombre,Mujer,Otro'],
            'tipo_zona' => ['required', 'string', 'in:Comuna,Corregimiento'],
            'zona' => ['required'],
        ];

        /* return $validate; */
    }
}
