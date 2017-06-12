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
            'Nit' => 'max:20',
            'RazonSocial' => 'required|max:500',
            'Direccion' => 'max:300',
            'Telefono' => 'max:15',
            'CorreoElectronico' => 'max:300',
            'Foto'=>'',
            'FechaModificacion'=>''
        ];
    }
}
