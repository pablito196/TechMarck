<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';

    protected $primaryKey = 'IdProveedor';

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

}
