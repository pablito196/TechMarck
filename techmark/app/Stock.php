<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table='existencia';

    protected $primaryKey='IdExistencia';

    public $timestamps=false;

    protected $fillable=[
    	'IdArticulo',
    	'IdAlmacen',
    	'CantidadExistente'
    ];

    protected $guarded =[];

    function scopeDescripcion($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }

    function articulo()
    {
        return $this->belongsTo('App\Articulo', 'IdArticulo');
    }

    function almacen()
    {
        return $this->belongsTo('App\Almacen', 'IdAlmacen');
    }


    function  deleteOk(){
        /*if($num>0)
            return false;
        else*/
            return true;
    }
}
