<?php

namespace App\Http\Requests\Problem;

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
        return [
            'creador' => ['required', 'exists:users,id'],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'identificacion' => ['required', 'string', 'min:8', 'max:15'],
            'telefono' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'vinculo' => ['required'],
            'puesto' => ['required'],
            'descripcion' => ['required', 'string', 'min:10'],
        ];
    }
}
