<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\ArticuloFormRequest;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\Familia;
use App\Marca;
use App\Medida;
use App\TipoArticulo;
use App\Tool;

use Carbon\Carbon;

use DB;


class ArticuloController extends Controller
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
	    		$this->datos['brand'] = Tool::brand('Articulos',route('almacen.articulo.index'),'Almacen');
	    		$this->datos['articulos'] = DB::table('articulo as a')
	    		->join('familia as f', 'a.IdFamilia','=','f.IdFamilia')
	    		->join('medida as me', 'a.IdMedida','=','me.IdMedida')
	    		->join('marca as ma', 'a.IdMarca','=','ma.IdMarca')
	    		->join('tipoarticulo as t', 'a.IdTipoArticulo','=','t.IdTipoArticulo')
	    		->join('usuario as u', 'a.IdUsuario','=','u.IdUsuario')
	    		->select('a.IdArticulo','a.Descripcion','f.Descripcion as familia','me.Descripcion as medida','ma.Descripcion as marca','t.Descripcion as tipoarticulo','a.FechaModificacion','u.NombreUsuario as usuario','a.Codigo')
	    		->orderBy('a.IdArticulo','desc')
	    		->paginate();
	    		return view('cpanel.almacen.articulo.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de articulos');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
    		$this->datos['familias']=Familia::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdFamilia');
    		$this->datos['medidas']=Medida::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdMedida');
    		$this->datos['marcas']=Marca::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdMarca');
    		$this->datos['tipo_articulo']=TipoArticulo::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdTipoArticulo');
            $this->datos['brand'] = Tool::brand('Crear Articulos',route('almacen.articulo.index'),'Articulos');
            return view('cpanel.almacen.articulo.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(ArticuloFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            Articulo::create($request->all());
            return redirect()->route('almacen.articulo.index');
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
    		$this->datos['familias']=Familia::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdFamilia');
    		$this->datos['medidas']=Medida::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdMedida');
    		$this->datos['marcas']=Marca::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdMarca');
    		$this->datos['tipo_articulo']=TipoArticulo::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdTipoArticulo');
            $this->datos['brand'] = Tool::brand('Editar Articulo',route('almacen.articulo.index'),'Articulos');
            $this->datos['articulo'] = Articulo::find($id);
            return view('cpanel.almacen.articulo.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(ArticuloFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $articulo = Articulo::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $articulo['FechaModificacion']=$tiempo->toDateTimeString();
            $articulo['IdUsuario']=Auth::id();
            $articulo->fill($request->all());
            $articulo->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.articulo.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $articulo = Articulo::find($id);
            \Session::flash('user-dead',$articulo->Descripcion);
            if(!$articulo->deleteOk()){
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Articulo::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.articulo.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }
}
