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
        $num = Articulo::where('IdTipoArticulo',$this->IdTipoArticulo)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
