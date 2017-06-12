<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso';

    protected $primaryKey='IdIngreso';

    public $timestamps=false;

    protected $fillable=[
    	'IdArticulo',
    	'IdAlmacen',
    	'Cantidad',
    	'Observacion',
    	'FechaIngreso',
    	'Eliminado',
    	'IdUsuario'
    ];

    function scopeObservacion($query,$name){
        if(trim($name) != ''){
            $query->where('Observacion','like',"%$name%");
        }
    }

    public function articulo()
    {
        return $this->belongsTo('App\Articulo','IdArticulo');
    }

    public function almacen()
    {
        return $this->belongsTo('App\Almacen', 'IdAlmacen');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'IdUsuario');
    }

    function  deleteOk(){
        /*$num = Stock::where('IdArticulo',$this->IdArticulo)->count();
        if($num>0)
            return false;
        else*/
            return true;
    }}
