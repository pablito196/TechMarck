<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stock;

class Almacen extends Model
{
    protected $table='almacen';

    protected $primaryKey='IdAlmacen';

    public $timestamps=false;

    protected $fillable=[
    	'Descripcion',
    	'Direccion',
    	'IdUsuario',
    	'FechaModificacion',
    	'Activo'
    ];

    protected $guarded =[];

    function scopeDescripcion($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }

    function stock()
    {
        return $this->hasMany('App\Stock','IdAlmacen');
    }

    function usuario()
    {
        return $this->belongsTo('App\User','IdUsuario');
    }

    function  deleteOk(){
        $num+=Stock::where('IdAlmacen',$this->IdAlmacen)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
