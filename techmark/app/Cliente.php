<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'cliente';
    protected $primaryKey = 'IdCliente';
    protected $fillable = [
        'RazonSocial', 'CorreoElectronico', 'Nit',
        'Direccion',
        'Telefono',
        'Foto',
        'FechaModificacion',
        'Activo',
        'IdUsuario'//aqui se pone todos tus campos en array
    ];
public $timestamps = false;
   function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('RazonSocial','like',"%$name%")
            ->orwhere('Nit','like',"%$name%");
        }
    }

    }