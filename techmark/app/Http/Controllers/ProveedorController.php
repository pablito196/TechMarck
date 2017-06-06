<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\ProveedorFormRequest;
use App\Http\Controllers\Controller;
use App\Proveedor;
use App\Tool;

use Carbon\Carbon;

use DB;

class ProveedorController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if(Auth::user()->can('allow-read'))
        {
            if ($request) 
            {
                $this->datos['brand'] = Tool::brand('Proveedores',route('proveedores.proveedor.index'),'Proveedor');
                $this->datos['proveedores'] = DB::table('proveedor as p')
                ->select('p.IdProveedor','p.Nit','p.RazonSocial','p.Direccion','p.Telefono','p.CorreoElectronico')
                ->where('p.Activo','1')
                ->orderBy('p.IdMarca','desc')
                ->paginate();
                return view('cpanel.proveedores.proveedor.list')->with($this->datos);
            }
        }
        
    }
    public function create()
    {
        return view("proveedores.proveedor.create");
    }  
    public function store(ProveedorFormRequest $request)
    {                                                                                                                                                                                                                            
        $proveedor =  new Proveedor;
        $proveedor->Nit = $request->('nit');
        $proveedor->RazonSocial = $request->('razonSocial');
        $proveedor->Direccion = $request->('direccion');
        $proveedor->Telefono = $request->('telefono');
        $proveedor->CorreoElectronico = $request->('correoElectronico');
        $proveedor->save();
        return Redirect::to('proveedores/proveedor');
    } 
    public function show($IdProveedor)
    {
        return view("proveedores.proveedor.show",["proveedor"=>Proveedor::findOrFail($IdProveedor)]);
    } 
    public function edit()
    {
        return view("proveedores.proveedor.edit",["proveedor"=>Proveedor::findOrFail($IdProveedor)]);
    } 
    public function update(ProveedorFormRequest $request,$IdProveedor)
    {
        $proveedor = Proveedor::findOrFail($IdProveedor);
        $proveedor->Nit = request->get('nit');
        $proveedor->RazonSocial = request->get('razonSocial');
        $proveedor->Direccion = request->get('direccion');
        $proveedor->Telefono = request->get('telefono');
        $proveedor->CorreoElectronico = request->get('correoElectronico');
        return Redirect::to('proveedores/proveedor');
    } 
    public function destroy($IdProveedor)
    {
        $proveedor = Proveedor::findOrFail($IdProveedor);
        $proveedor->Activo = 1;
        $proveedor->update();
        return Redirect::to('proveedores/proveedor');
    } 
}
