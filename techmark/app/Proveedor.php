<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';

    protected $primarykey = 'IdProveedor';

    public $timestamps = false;

    protected $fillable = [
    	'Nit',
    	'RazonSocial',
    	'Direccion',
    	'Telefono',
    	'CorreoElectronico',
    	'Foto',
    	'FechaModificacion',
    	'Activo'
    ]; 

    protected $guarded = [

    ];

}
