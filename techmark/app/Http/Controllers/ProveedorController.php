<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\ProveedorFormRequest;
use App\Http\Controllers\Controller;
use App\Proveedor;
use App\Tool;

use Carbon\Carbon;

use DB;

class ProveedorController extends Controller
{

    private $datos=null;

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            if ($request) 
            {
                $this->datos['brand'] = Tool::brand('Proveedor',route('proveedores.proveedor.index'),'Proveedores');
                $this->datos['proveedores'] = Proveedor::where('Activo',true)
                ->orderBy('IdProveedor','desc')
                ->paginate();
                return view('cpanel.proveedores.proveedor.list')->with($this->datos);
            }
            \Session::flash('message','No existen registros de proveedores');
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
        
    }

    public function create()
    {
        $this->datos['brand'] = Tool::brand('Crear Proveedor',route('proveedores.proveedor.index'),'Proveedores');
        return view("cpanel.proveedores.proveedor.registro")->with($this->datos);
    }  

    public function store(ProveedorFormRequest $request)
    {                                                                                                                                                                                                                            
        if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            Proveedor::create($request->all());
            return redirect()->route('proveedores.proveedor.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    } 

    public function show($id)
    {
        //
    } 

    public function edit($id)
    {
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Proveedor',route('proveedores.proveedor.index'),'Proveedores');
            $this->datos['proveedor'] = Proveedor::find($id);
            return view("cpanel.proveedores.proveedor.edit",$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(ProveedorFormRequest $request,$id)
    {
        if(Auth::user()->can('allow-edit')){
            $proveedor = Proveedor::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $proveedor['FechaModificacion']=$tiempo->toDateTimeString();
            $proveedor->fill($request->all());
            $proveedor->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('proveedores.proveedor.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    } 

    public function destroy($id)
    {
        if(Auth::user()->can('allow-delete')) {
            $proveedor = Proveedor::find($id);
            \Session::flash('user-dead',$proveedor->RazonSocial);
            if(!$proveedor->deleteOk()){
                $mensaje = 'El proveedor  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Proveedor::destroy($id);
                $mensaje = 'El proveedor fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('proveedores.proveedor.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    } 
}