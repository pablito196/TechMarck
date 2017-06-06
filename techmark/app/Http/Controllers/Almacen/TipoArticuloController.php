<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\TipoArticuloFormRequest;
use App\Http\Controllers\Controller;
use App\TipoArticulo;
use App\Tool;

use DB;

class TipoArticuloController extends Controller
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
	    		$this->datos['brand'] = Tool::brand('Tipo Articulos',route('almacen.tipoarticulo.index'),'Almacen');
	    		$this->datos['tipoarticulos'] = DB::table('tipoarticulo as t')
	    		->join('usuario as u', 't.IdUsuario','=','u.IdUsuario')
	    		->select('t.IdTipoArticulo','t.Descripcion','u.NombreUsuario as usuario')
	    		->orderBy('t.IdTipoArticulo','desc')
	    		->paginate();
	    		return view('cpanel.almacen.tipoarticulo.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de tipos de articulos');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Tipo de Articulo',route('almacen.marca.index'),'Tipo de Articulos');
            return view('cpanel.almacen.tipoarticulo.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(TipoArticuloFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $request['IdUsuario']=Auth::id();
            TipoArticulo::create($request->all());
            return redirect()->route('almacen.tipoarticulo.index');
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
            $this->datos['brand'] = Tool::brand('Editar Tipo de Articulo',route('almacen.tipoarticulo.index'),'Tipos de Articulos');
            $this->datos['tipoarticulo'] = TipoArticulo::find($id);
            return view('cpanel.almacen.tipoarticulo.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(TipoArticuloFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $tipoarticulo = TipoArticulo::find($id);
            $tipoarticulo['IdUsuario']=Auth::id();
            $tipoarticulo->fill($request->all());
            $tipoarticulo->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.tipoarticulo.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $tipoarticulo = TipoArticulo::find($id);
            \Session::flash('user-dead',$tipoarticulo->Descripcion);
            if(!$tipoarticulo->deleteOk()){
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                TipoArticulo::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.tipoarticulo.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
