<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Stock;

class Articulo extends Model
{
    protected $table='articulo';

    protected $primaryKey='IdArticulo';

    public $timestamps=false;

    protected $fillable=[
    	'Descripcion',
    	'IdFamilia',
    	'IdMedida',
    	'IdMarca',
    	'IdTipoArticulo',
    	'FechaModificacion',
    	'IdUsuario',
    	'Codigo'
    ];

    protected $guarded =[];

    function scopeDescripcion($query,$name){
        if(trim($name) != ''){
            $query->where('Descripcion','like',"%$name%");
        }
    }

    function scopeCodigo($query,$name)
    {
        if(trim($name) != ''){
            $query->where('Codigo','like',"%$name%");
        }
    }

    public function stock()
    {
        return $this->hasMany('App/Stock','IdArticulo');
    }

    public function familia()
    {
        return $this->belongsTo('App\Familia','IdFamilia');
    }

    public function medida()
    {
        return $this->belongsTo('App\Medida', 'IdMedida');
    }

    public function marca()
    {
        return $this->belongsTo('App\Marca', 'IdMarca');
    }

    public function tipoarticulo()
    {
        return $this->belongsTo('App\TipoArticulo', 'IdTipoArticulo');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'IdUsuario');
    }

    function  deleteOk(){
        $num = Stock::where('IdArticulo',$this->IdArticulo)->count();
        if($num>0)
            return false;
        else
            return true;
    }
}
