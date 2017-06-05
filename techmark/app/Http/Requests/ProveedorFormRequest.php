<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProveedorFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;                                                                         ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nit' => 'max:20',
            'razonSocial' => 'required|max:500',
            'direccion' => 'max:300',
            'telefono' => 'max:15',
            'correoElectronico' => 'max:300',
        ];
    }
}
