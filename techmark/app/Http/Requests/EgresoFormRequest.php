<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EgresoFormRequest extends Request
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
            'IdArticulo'=>'required',
            'IdAlmacen'=>'required',
            'Cantidad'=>'required|numeric',
            'Observacion'=>'max:500',
            'FechaEgreso'=>'date',
            'Eliminado'=>'',
            'IdUsuario'=>''
        ];
    }
}
