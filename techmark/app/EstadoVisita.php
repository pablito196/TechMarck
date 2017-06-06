<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    //
    protected $table = 'estadovisita';
    protected $primaryKey = 'IdEstadoVisita';
    protected $fillable = [
        'Descripcion'
        'Activo'
        //aqui se pone todos tus campos en array
    ];
public $timestamps = false;
protected $guarded =[];
   function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('RazonSocial','like',"%$name%")
            ->orwhere('Nit','like',"%$name%");
        }
    }

    }