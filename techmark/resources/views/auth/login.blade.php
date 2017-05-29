@extends('theme.ubold.layout_login')

@section('content')
    @if(Session::has('message-middleware'))
        <div class="alert alert-danger" role="alert">  {{Session::get('message-middleware')}}</div>
    @endif
    <div class="panel-body">
        @if($errors->has())
            <div class="alert alert-warning" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            <hr>
        @endif
            <form class="form-horizontal m-t-20" action="{{ url('/login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="text" required="" placeholder="Usuario" name="NombreUsuario" value="{{ old('NombreUsuario') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="password" required="" placeholder="Contraseña" name="password">
                </div>
            </div>

            <div class="form-group ">
                <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox-signup" type="checkbox" name="remember">
                        <label for="checkbox-signup"> Recordar cuenta </label>
                    </div>

                </div>
            </div>

            <div class="form-group text-center m-t-40">
                <div class="col-xs-12">
                    <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">
                        Entrar
                    </button>
                </div>
            </div>



        </form>

    </div>




@endsection
