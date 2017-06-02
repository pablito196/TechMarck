<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Proveedor;
use Illuminate\Supoport\Facades\Redirect;
use App\Http\Requests\ProveedorFormRequest;
use DB;

class ProveedorController extends Controller
{
    public function __construct()
 	{

 	}

 	public function index(Request $request)
 	{
 		if ($request) {
 			$query = trim($request->get('serchText'));
 			$proveedores = DB::table('proveedor')->where('RazonSocial','LIKE','%'.$query.'%')
 			->orderBy('IdProveedor','asc')
 			->paginate(10);
 			return view('proveedores.proveedor.index',["proveedores"=>$proveedores,"searchText"=>$query]);
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
