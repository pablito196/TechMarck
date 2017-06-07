<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table='marca';

    protected $primaryKey='IdMarca';

    public $timestamps=false;

    protected $fillable=[
    	'Descripcion',
    	'FechaModificacion',
    	'IdUsuario',
    	'Activo'
    ];

    protected $guarded =[];

    function scopeDescripcion($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'IdUsuario');
    }

    function  deleteOk(){
        $num = Articulo::where('IdMarca',$this->IdMarca)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
