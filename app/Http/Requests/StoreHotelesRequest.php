<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelesRequest extends FormRequest
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
            'nombre' => 'required|unique:hoteles',
            'ciudad' => 'required',
            'num_habitantes' => 'required',
            'direccion' => 'required|unique:hoteles',
            'nit' => 'required'
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'El campo nombre es requerido',
            'ciudad.required' => 'El campo ciudad es requerido',
            'num_habitantes.required' => 'El numero de campo habitantes es requerido',
            'direccion.required' => 'El campo direccion es requerido',
            'nit.required' => 'El campo nit es requerido',
            'nombre.unique' => 'Este nombre ya existe',
            'direccion.unique' => 'Esta direccion ya existe'
        ];
    }
}
