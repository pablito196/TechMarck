@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="pull-right">
                    {!! Form::open(['route'=>['almacen.tipoarticulo.destroy',$tipoarticulo->IdTipoArticulo],'method'=>'delete','id'=>'form-delete']) !!}
                    <a class="btn btn-danger" id="btn-delete"> <i class="fa fa-trash"></i> Eliminar</a>
                    {!! Form::close() !!}
                </div>
                <h4 class="m-t-0 header-title"><b>Formulario para Actualizacion de Datos</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>

                @include('cpanel.partials.errors')
                {!! Form::model($tipoarticulo,['route'=>['almacen.tipoarticulo.update',$tipoarticulo->IdTipoArticulo],'method'=>'PUT','files'=>true,'id'=>'form-tipoarticulo']) !!}
                    @include('cpanel.almacen.tipoarticulo.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Actualizar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection

@section('css')
    @include('cpanel.almacen.tipoarticulo.addons.css')
@endsection
@section('js')
    @include('cpanel.almacen.tipoarticulo.addons.js')
@endsection