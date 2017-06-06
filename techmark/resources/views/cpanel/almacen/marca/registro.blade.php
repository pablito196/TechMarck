@extends('theme.ubold.layout_cpanel')
@section('content')
    @include('cpanel.partials.brand')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Formulario de Registro de Marcas</b></h4>
                <p class="text-danger font-13 m-b-30">
                    * Los campos con (*) son obligatorios
                </p>
                @include('cpanel.partials.errors')
                {!! Form::open(['route'=>'almacen.marca.store','method'=>'POST','files'=>true,'id'=>'form-medida']) !!}
                    @include('cpanel.almacen.marca.partials.fields')
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Registrar
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Cancelar
                        </button>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection

@section('css')
    @include('cpanel.almacen.marca.addons.css')
@endsection
@section('js')
    @include('cpanel.almacen.marca.addons.js')
@endsection