<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    //
    protected $table = 'visita';
    protected $primaryKey = 'IdVisita';
    protected $fillable = [
        'IdCliente', 
        'FechaVisitar',
        'FechaVisitada',
        'Direccion',
        'Telefono',
        'IdUsuario',
        'FechaModificacion',
        'EstadoVisita'
        //aqui se pone todos tus campos en array
    ];
public $timestamps = false;
   function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('RazonSocial','like',"%$name%")
            ->orwhere('Nit','like',"%$name%");
        }
    function scopeNit($query,$nit){
        if(trim($nit) != ''){
            $query->where('Nit','like',"%$nit%")
            ->orwhere('Nit','like',"%$name%");
        }
    }
}