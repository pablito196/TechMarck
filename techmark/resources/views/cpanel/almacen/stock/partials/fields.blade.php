<div>
	{!! Form::label('Almacen (*) ')!!}
	{!! Form::select('IdAlmacen',$almacenes,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Articulo (*)')!!}
	{!! Form::select('IdArticulo',$articulos,null,['class'=>'selectpicker','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Stock ')!!}
    {!! Form::text('CantidadExistente',null,['class'=>'form-control','required','placeholder'=>'Numero...'])!!}
</div>