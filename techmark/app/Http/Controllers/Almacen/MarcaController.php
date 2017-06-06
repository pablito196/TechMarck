<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\MarcaFormRequest;
use App\Http\Controllers\Controller;
use App\Marca;
use App\Tool;

use Carbon\Carbon;

use DB;

class MarcaController extends Controller
{
    private $datos=null;

    public function _construct()
    {

    }

    public function index(Request $request)
    {
    	if(Auth::user()->can('allow-read'))
    	{
	    	if ($request)
	    	{
	    		$this->datos['brand'] = Tool::brand('Marcas',route('almacen.marca.index'),'Almacen');
	    		$this->datos['marcas'] = DB::table('marca as m')
	    		->join('usuario as u', 'm.IdUsuario','=','u.IdUsuario')
	    		->select('m.IdMarca','m.Descripcion','m.FechaModificacion','u.NombreUsuario as usuario')
                ->where('m.Activo','1')
	    		->orderBy('m.IdMarca','desc')
	    		->paginate();
	    		return view('cpanel.almacen.marca.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de marcas');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Marca',route('almacen.marca.index'),'Marcas');
            return view('cpanel.almacen.marca.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(MarcaFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            Marca::create($request->all());
            return redirect()->route('almacen.marca.index');
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
            $this->datos['brand'] = Tool::brand('Editar Marca',route('almacen.marca.index'),'Marcas');
            $this->datos['marca'] = Marca::find($id);
            return view('cpanel.almacen.marca.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(MarcaFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $marca = Marca::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $marca['FechaModificacion']=$tiempo->toDateTimeString();
            $marca['IdUsuario']=Auth::id();
            $marca->fill($request->all());
            $marca->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.marca.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $marca = Marca::find($id);
            \Session::flash('user-dead',$marca->Descripcion);
            if(!$marca->deleteOk()){
                $marca->Activo=chr(0);
                $marca->save();
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Marca::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.marca.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
