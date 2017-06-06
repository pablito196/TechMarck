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

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%")
            ->orwhere('Direccion','like','%$name%');
        }
    }

    function allowEdit(){
        return $this->edit==1;
    }

    function allowInsert(){
        return $this->insert==1;
    }

    function allowDelete(){
        return $this->delete==1;
    }

    function allowRead(){
        return $this->read==1;
    }

    function  deleteOk(){
        $num+=Stock::where('IdAlmacen',$this->IdAlmacen)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
