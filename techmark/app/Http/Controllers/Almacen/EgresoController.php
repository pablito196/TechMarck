<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\EgresoFormRequest;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\Almacen;
use App\Egreso;
use App\Tool;

use Carbon\Carbon;

use DB;

class EgresoController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
    	if(Auth::user()->can('allow-read'))
    	{
	    	if ($request)
	    	{
	    		$this->datos['brand'] = Tool::brand('Egresos',route('almacen.egreso.index'),'Almacen');
	    		$this->datos['egresos'] = Egreso::with('articulo','almacen','usuario')
	    		->where('Eliminado',true)
                ->observacion($request->get('s'))
                ->orderBy('IdEgreso','desc')
	    		->paginate();
	    		return view('cpanel.almacen.egreso.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de egresos');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
    		$this->datos['articulos']=Articulo::orderBy('Descripcion')->pluck('Descripcion','IdArticulo');
    		$this->datos['almacenes']=Almacen::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdAlmacen');
            $this->datos['brand'] = Tool::brand('Nuevo Egreso',route('almacen.egreso.index'),'Egresos');
            return view('cpanel.almacen.egreso.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(EgresoFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaEgreso']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            $request['Eliminado']=true;
            Egreso::create($request->all());
            return redirect()->route('almacen.egreso.index');
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
    		$this->datos['articulos']=Articulo::orderBy('Descripcion')->pluck('Descripcion','IdArticulo');
    		$this->datos['almacenes']=Almacen::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdAlmacen');
            $this->datos['brand'] = Tool::brand('Editar Egreso',route('almacen.egreso.index'),'Egresos');
            $this->datos['egreso'] = Egreso::find($id);
            return view('cpanel.almacen.egreso.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(EgresoFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $egreso = Egreso::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $egreso['FechaEgreso']=$tiempo->toDateTimeString();
            $egreso['IdUsuario']=Auth::id();
            $egreso->fill($request->all());
            $egreso->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.egreso.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $egreso = Egreso::find($id);
            \Session::flash('user-dead',$egreso->IdEgreso);
            if(!$egreso->deleteOk()){
                $mensaje = 'El egreso Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Egreso::destroy($id);
                $mensaje = 'El egreso  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.egreso.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }
}