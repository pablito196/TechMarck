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

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
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
        /*if($num>0)
            return false;
        else*/
            return true;
    }
}
