<div class="form-group col-lg-12">
    {!! Form::label('Descripcion ')!!}
    {!! Form::text('Descripcion',null,['class'=>'form-control','required','placeholder'=>'Descripcion...'])!!}
</div>

<div>
	{!! Form::label('Familia (*) ')!!}
	{!! Form::select('IdFamilia',$familias,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Medida (*)')!!}
	{!! Form::select('IdMedida',$medidas,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Marca (*)')!!}
	{!! Form::select('IdMarca',$marcas,null,['class'=>'selectpicker','required'])!!}
</div>

<div>
	{!! Form::label('Tipo Articulo (*)')!!}
	{!! Form::select('IdTipoArticulo',$tipo_articulo,null,['class'=>'selectpicker','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Codigo ')!!}
    {!! Form::text('Codigo',null,['class'=>'form-control','required','placeholder'=>'Codigo...'])!!}
</div>