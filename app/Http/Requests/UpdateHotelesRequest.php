<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelesRequest extends FormRequest
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
            'ciudad' => 'required',
            'num_habitantes' => 'required',
            'direccion' => 'required',
            'nit' => 'required'
        ];
    }

   /**
    * The messages() function returns an array of messages that are displayed when validation fails
    */
    public function messages(){
        return [
            'nombre.required' => 'El campo nombre es requerido',
            'ciudad.required' => 'El campo ciudad es requerido',
            'num_habitantes.required' => 'El numero de campo habitantes es requerido',
            'direccion.required' => 'El campo direccion es requerido',
            'nit.required' => 'El campo nit es requerido'
        ];
    }
}
