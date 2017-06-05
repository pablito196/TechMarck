<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClienteFormRequest extends Request
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
        'RazonSocial'=>'required|max:200', 
        'CorreoElectronico'=>'max:50', 
        'Nit'=>'required|max:15',
        'Direccion'=>'max:70',
        'Telefono'=>'max:15',
        'FechaModicacion'=>'date',
        
        'Foto'=>'mimes:jpg,bpm,png'
        ];
    }
}
