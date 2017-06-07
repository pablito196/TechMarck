<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\MedidaFormRequest;
use App\Http\Controllers\Controller;
use App\Medida;
use App\Tool;

use Carbon\Carbon;

use DB;

class MedidaController extends Controller
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
	    		$this->datos['brand'] = Tool::brand('Medidas',route('almacen.medida.index'),'Almacen');
	    		$this->datos['medidas'] = Medida::with('usuario')
                ->where('Activo','1')
                ->descripcion($request->get('s'))
	    		->orderBy('IdMedida','desc')
	    		->paginate();
	    		return view('cpanel.almacen.medida.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de medidas');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Medidas',route('almacen.medida.index'),'Medidas');
            return view('cpanel.almacen.medida.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(MedidaFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            $request['IdUsuario']=Auth::id();
            Medida::create($request->all());
            return redirect()->route('almacen.medida.index');
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
            $this->datos['brand'] = Tool::brand('Editar Medida',route('almacen.medida.index'),'Medidas');
            $this->datos['medida'] = Medida::find($id);
            return view('cpanel.almacen.medida.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(MedidaFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $medida = Medida::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $medida['FechaModificacion']=$tiempo->toDateTimeString();
            $medida['IdUsuario']=Auth::id();
            $medida->fill($request->all());
            $medida->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.medida.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $medida = Medida::find($id);
            \Session::flash('user-dead',$medida->Descripcion);
            if(!$medida->deleteOk()){
                $medida->Activo=chr(0);
                $medida->save();
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Medida::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.medida.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
