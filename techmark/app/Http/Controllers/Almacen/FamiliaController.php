<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\FamiliaFormRequest;
use App\Http\Controllers\Controller;
use App\Familia;
use App\Tool;

use Carbon\Carbon;

use DB;

class FamiliaController extends Controller
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
	    		$this->datos['brand'] = Tool::brand('Familias',route('almacen.familia.index'),'Almacen');
	    		$this->datos['familias'] = DB::table('familia as f')
	    		->join('usuario as u', 'f.IdUsuario','=','u.IdUsuario')
	    		->select('f.IdFamilia','f.Descripcion','f.FechaModificacion','u.NombreUsuario as usuario')
                ->where('f.Activo','1')
	    		->orderBy('f.IdFamilia','desc')
	    		->paginate();
	    		return view('cpanel.almacen.familia.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de familias');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Familias',route('almacen.familia.index'),'Familias');
            return view('cpanel.almacen.familia.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(FamiliaFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            Familia::create($request->all());
            return redirect()->route('almacen.familia.index');
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
            $this->datos['brand'] = Tool::brand('Editar Familia',route('almacen.familia.index'),'Familias');
            $this->datos['familia'] = Familia::find($id);
            return view('cpanel.almacen.familia.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(FamiliaFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $familia = Familia::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $familia['FechaModificacion']=$tiempo->toDateTimeString();
            $familia['IdUsuario']=Auth::id();
            $familia->fill($request->all());
            $familia->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.familia.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $familia = Familia::find($id);
            \Session::flash('user-dead',$familia->Descripcion);
            if(!$familia->deleteOk()){
                $familia->Activo=chr(0);
                $familia->save();
                $mensaje = 'La familia que intenta eliminar tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Familia ';
            }
            else{
                Familia::destroy($id);
                $mensaje = 'La Familia fue eliminada ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.familia.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }
}