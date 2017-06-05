<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'cliente';
    protected $primaryKey = 'IdCliente';
    protected $fillable = [
        'RazonSocial', 'CorreoElectronico', 'Nit',
        'Direccion',
        'Telefono',
        'Foto',
        'FechaModificacion',
        'Activo',
        'IdUsuario'//aqui se pone todos tus campos en array
    ];
public $timestamps = false;
protected $guarded =[];
   function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('RazonSocial','like',"%$name%")
            ->orwhere('Nit','like',"%$name%");
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
        /*$num = Inmueble::where('usuarios_id',$this->id)->count();
        $num+= Ciudad::where('usuarios_id',$this->id)->count();
        $num+= Zona::where('usuarios_id',$this->id)->count();
        $num+= Departamento::where('usuarios_id',$this->id)->count();
        $num+= Empresa::where('usuarios_id',$this->id)->count();
        $num+= Galeria::where('usuarios_id',$this->id)->count();
        $num+=Responsable::where('usuarios_id',$this->id)->count();
        $num+=TipOfertas::where('usuarios_id',$this->id)->count();
        $num+=TipInmuebles::where('usuarios_id',$this->id)->count();
        $num+=News::where('usuarios_id',$this->id)->count();
        if($num>0)
            return false;
        else*/
            return true;
    }

    }