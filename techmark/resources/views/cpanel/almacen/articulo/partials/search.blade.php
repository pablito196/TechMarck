
{!! Form::model(Request::all(), ['route' => ['almacen.articulo.index'],'method'=>'GET']) !!}
        <div class="form-group">
            <div class="input-group">
                {!!  Form::text('s',null,['class'=>"form-control" ,'placeholder'=>"Buscar por nombre o codigo"]) !!}
                <span class="input-group-btn">
                    <button type="button" class="btn waves-effect waves-light btn-primary"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div> <!-- form-group -->
{!! Form::close() !!}
