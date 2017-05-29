<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'usuario';
    protected $primaryKey = 'IdUsuario';
    protected $fillable = [
        'NombreUsuario', 'email', 'password',
        'read',
        'insert',
        'delete',
        'edit',//aqui se pone todos tus campos en array
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public  function  setPasswordAttribute($value){
        if(!empty($value)){
            $this->attributes['password']=\Hash::make($value);
        }

    }
    function scopeName($query,$name){
        if(trim($name) != ''){
            $query->where('NombreUsuario','like',"%$name%");
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
    //definir si el susuario tiene relaciones
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
