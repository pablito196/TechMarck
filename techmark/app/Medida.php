<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $table='medida';

    protected $primaryKey='IdMedida';

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
        $num = Articulo::where('IdMedida',$this->IdMedida)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
