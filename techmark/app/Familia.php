<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Articulo;

class Familia extends Model
{
    protected $table='familia';

    protected $primaryKey='IdFamilia';

    public $timestamps=false;

    protected $fillable=[
    	'Descripcion',
    	'FechaModificacion',
    	'IdUsuario',
    	'Activo'
    ];

    protected $guarded =[];

    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }

    function articulo()
    {
        return $this->hasMany('Articulo', 'IdFamilia');
    }

    function  deleteOk(){
        $num = Articulo::where('IdFamilia',$this->IdFamilia)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
