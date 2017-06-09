<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\AlmacenFormRequest;
use App\Http\Controllers\Controller;
use App\Almacen;
use App\Tool;

use Carbon\Carbon;

use DB;

class AlmacenController extends Controller
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
	    		$this->datos['brand'] = Tool::brand('Almacenes',route('almacen.almacen.index'),'Almacen');
	    		$this->datos['almacenes'] = Almacen::with('stock.articulo','usuario')
                ->descripcion($request->get('s'))
                ->where('Activo','1')
	    		->orderBy('IdAlmacen','desc')
	    		->paginate();
	    		return view('cpanel.almacen.almacen.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de marcas');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Almacen',route('almacen.almacen.index'),'Almacenes');
            return view('cpanel.almacen.almacen.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(AlmacenFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            Almacen::create($request->all());
            return redirect()->route('almacen.almacen.index');
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
            $this->datos['brand'] = Tool::brand('Editar Almacen',route('almacen.almacen.index'),'Almacenes');
            $this->datos['almacen'] = Almacen::find($id);
            return view('cpanel.almacen.almacen.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(MarcaFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $almacen = Almacen::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $almacen['FechaModificacion']=$tiempo->toDateTimeString();
            $almacen['IdUsuario']=Auth::id();
            $almacen->fill($request->all());
            $almacen->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.almacen.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $almacen = Almacen::find($id);
            \Session::flash('user-dead',$almacen->Descripcion);
            if(!$almacen->deleteOk()){
                $almacen->Activo=chr(0);
                $almacen->save();
                $mensaje = 'El almacen  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Almacen::destroy($id);
                $mensaje = 'El almacen  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.almacen.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
