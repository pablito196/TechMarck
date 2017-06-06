<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Requests;
use App\Cliente;
use App\User;
use App\Visita;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\VisitaFormRequest;
use Illuminate\Http\Request;
use App\Tool;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class VisitaController extends Controller
{
    private  $datos = null;

    public function _construct()
    {

    }

 
    public function index(Request $request)
    {

       if(Auth::user()->can('allow-read')){
        if ($request)
            {
            $this->datos['brand'] = Tool::brand('Visita',route('ventas.visita.index'),'Visitas');
            $this->datos['visitas'] = Visita::where('EstadoVisita',1)
                ->name($request->get('s'))
                ->orderBy('FechaVisitar','asc')
                ->paginate();
            return view('cpanel.ventas.visitas.list')->with($this->datos);
        }
        \Session::flash('message','No existen registros de clientes');
        }

        \Session::flash('message','No tienes Permiso para visualizar informacion ');
        return redirect('dashboard');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('allow-insert')){
            $this->datos['brand'] = Tool::brand('Crear Visita',route('ventas.visita.index'),'Clientes');
            return view('cpanel.ventas.visitas.registro',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');
    }
    public function store(VisitaFormRequest $request)
    {
        if(Auth::user()->can('allow-insert')){
            $tiempo=Carbon::now('America/La_Paz');
            $request['FechaModificacion']=$tiempo->toDateTimeString();
            Visita::create($request->all());
            return redirect()->route('ventas.visita.index');
        }

        \Session::flash('message','No tienes Permisos para agregar registros ');
        return redirect('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // dd(User::find($id));
        if(Auth::user()->can('allow-edit')){
            $this->datos['brand'] = Tool::brand('Editar Visita',route('ventas.visita.index'),'Cliente');
            $this->datos['visita'] = Visita::find($id);
            return view('cpanel.ventas.visitas.edit',$this->datos);
        }

        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }


    public function update(VisitaFormRequest $request, $id)
    {
        if(Auth::user()->can('allow-edit')){
            $visita = Visita::find($id);
            $tiempo=Carbon::now('America/La_Paz');
            $visita['FechaModificacion']=$tiempo->toDateTimeString();
            $visita->fill($request->all());
            $visita->save();
            \Session::flash('message','Se Actualizo Exitosamente la información');
            return redirect()->back();
        }
        \Session::flash('message','No tienes Permisos para editar ');
        return redirect('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(Auth::user()->can('allow-delete')) {
            $visita = Visita::find($id);
            \Session::flash('user-dead',$visita->Nit);
            if(!$visita->deleteOk()){
                $mensaje = 'El usuario  Tiene algunas Transacciones Registradas.. Imposible Eliminar. Se Inhabilito la Cuenta ';
            }
            else{
                Visita::destroy($id);
                $mensaje = 'El usuario  fue eliminado ';

            }
            \Session::flash('message',$mensaje);
            return redirect()->route('ventas.cliente.index');
        }
        \Session::flash('message','No tienes Permisos para Borrar informacion');
        return redirect('dashboard');

    }
}
