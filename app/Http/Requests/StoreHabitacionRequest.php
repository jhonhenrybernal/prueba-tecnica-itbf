<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHabitacionRequest extends FormRequest
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
     * - No deben existir hoteles repetidos
     *- No debe existir tipos de habitaciones y acomodaciones repetidas para el mismo hotel
     *
     * @return array
     */
    public function rules($id=0)
    {
        return [
            "cantidad" => "required|unique:habitacions". ($this->post('id') ? ",id,$this->post('id')" : ''), 
            "tipo" => "required|unique:habitacions". ($this->post('id') ? ",id,$this->post('id')" : ''), 
            "acomodacion" => "required|unique:habitacions". ($this->post('id') ? ",id,$this->post('id')" : ''), 
            "hotel_id" => "required" 
        ];
    }

   /**
    * The messages() function returns an array of messages that are displayed when validation fails
    */
     public function messages(){
        return [
            'cantidad.required' => 'El campo cantidad es requerido',
            'tipo.required' => 'El campo tipo es requerido',
            'acomodacion.required' => 'El numero acomodacion  es requerido',
            'hotel_id.required' => 'El campo hotel es requerido',
            'cantidad.unique' => 'El campo cantidad es requerido',
            'tipo.unique' => 'El campo tipo con el nombre '.$this->post('tipo').' para este hotel ya existe',
            'acomodacion.unique' => 'El campo acomodacion con el nombre '.$this->post('acomodacion').' para este hotel ya existe',
            
          
        ];
    }
}
