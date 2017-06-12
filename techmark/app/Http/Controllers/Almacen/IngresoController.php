<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\IngresoFormRequest;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\Almacen;
use App\Ingreso;
use App\Tool;

use Carbon\Carbon;

use DB;

class IngresoController extends Controller
{
    private $datos=null;

    public function index(Request $request)
    {
    	if(Auth::user()->can('allow-read'))
    	{
	    	if ($request)
	    	{
	    		$this->datos['brand'] = Tool::brand('Ingresos',route('almacen.ingreso.index'),'Almacen');
	    		$this->datos['ingresos'] = Ingreso::with('articulo','almacen','usuario')
	    		->where('Eliminado',true)
                ->observacion($request->get('s'))
                ->orderBy('IdIngreso','desc')
	    		->paginate();
	    		return view('cpanel.almacen.ingreso.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de ingresos');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
    		$this->datos['articulos']=Articulo::orderBy('Descripcion')->pluck('Descripcion','IdArticulo');
    		$this->datos['almacenes']=Almacen::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdAlmacen');
            $this->datos['brand'] = Tool::brand('Nuevo Ingreso',route('almacen.ingreso.index'),'Ingresos');
            return view('cpanel.almacen.ingreso.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(IngresoFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaIngreso']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            $request['Eliminado']=true;
            Ingreso::create($request->all());
            return redirect()->route('almacen.ingreso.index');
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
            $this->datos['brand'] = Tool::brand('Editar Articulo',route('almacen.articulo.index'),'Articulos');
            $this->datos['ingreso'] = Ingreso::find($id);
            return view('cpanel.almacen.ingreso.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(IngresoFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $ingreso = Ingreso::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $ingreso['FechaIngreso']=$tiempo->toDateTimeString();
            $ingreso['IdUsuario']=Auth::id();
            $ingreso->fill($request->all());
            $ingreso->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.ingreso.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $ingreso = Ingreso::find($id);
            \Session::flash('user-dead',$ingreso->IdIngreso);
            if(!$ingreso->deleteOk()){
                $mensaje = 'El ingreso Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Ingreso::destroy($id);
                $mensaje = 'El ingreso  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.ingreso.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }
}