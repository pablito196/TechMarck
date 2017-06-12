<div>
	{!! Form::label('Articulo (*) ')!!}
	{!! Form::select('IdArticulo',$articulos,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Almacen (*)')!!}
	{!! Form::select('IdAlmacen',$almacenes,null,['class'=>'selectpicker','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Cantidad (*)')!!}
    {!! Form::text('Cantidad',null,['class'=>'form-control','required','placeholder'=>'Cantidad...'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Observaciones (*)')!!}
    {!! Form::text('Observacion',null,['class'=>'form-control','required','placeholder'=>'Observaciones...'])!!}
</div>