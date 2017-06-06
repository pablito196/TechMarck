<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
    protected $table='tipoarticulo';

    protected $primaryKey='IdTipoArticulo';

    public $timestamps=false;

    protected $fillable=[
    	'Descripcion',
    	'IdUsuario',
    	'Activo'
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
        $num = Articulo::where('IdTipoArticulo',$this->IdTipoArticulo)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
