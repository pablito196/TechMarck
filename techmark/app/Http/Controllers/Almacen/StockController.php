<?php

namespace App\Http\Controllers\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\StockFormRequest;
use App\Http\Controllers\Controller;
use App\Almacen;
use App\Articulo;
use App\Stock;
use App\Tool;

use DB;

class StockController extends Controller
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
	    		$this->datos['brand'] = Tool::brand('Stock',route('almacen.stock.index'),'Almacen');
	    		$this->datos['haberes'] = Articulo::with('stock.almacen')
                ->descripcion($request->get('s'))
	    		->orderBy('Descripcion','asc')
	    		->paginate();
	    		return view('cpanel.almacen.stock.list')->with($this->datos);
	    	}
	    	\Session::flash('message','No existen registros de marcas');
    	}

    	\Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');
    }

    public function create()
    {
    	if(Auth::user()->can('allow-insert')){
            $this->datos['articulos']=Articulo::orderBy('Descripcion')->pluck('Descripcion','IdArticulo');
            $this->datos['almacenes']=Almacen::where('Activo',true)->orderBy('Descripcion')->pluck('Descripcion','IdAlmacen');
            $this->datos['brand'] = Tool::brand('Aumentar Stock',route('almacen.stock.index'),'Stock');
            return view('cpanel.almacen.stock.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }

    public function store(StockFormRequest $request)
    {
    	if(Auth::user()->can('allow-insert')){
            Stock::create($request->all());
            return redirect()->route('almacen.stock.index');
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
            $this->datos['brand'] = Tool::brand('Editar Stock',route('almacen.stock.index'),'Stock');
            $this->datos['haber'] = Stock::find($id);
            return view('cpanel.almacen.stock.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function update(StockFormRequest $request, $id)
    {
    	if(Auth::user()->can('allow-edit')){
            $stock = Stock::find($id);
            $stock->fill($request->all());
            $stock->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->route('almacen.stock.index');
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');
    }

    public function destroy($id)
    {
    	if(Auth::user()->can('allow-delete')) {
            $stock = Stock::find($id);
            \Session::flash('user-dead',$stock->IdExistencia);
            if(!$stock->deleteOk()){
                $mensaje = 'El almacen  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Almacen::destroy($id);
                $mensaje = 'El almacen  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('almacen.stock.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');
    }}
