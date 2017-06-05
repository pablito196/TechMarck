@if(Request::segment(4)=='edit')
    <div class="form-group col-lg-12" >
        {!! Form::label('Estado de la Cuenta (*) ')!!}
        {!! Form::select('Activo',['1'=>'Activa','0'=>'Inhabilitado'],null,['class'=>'selectpicker','required'])!!}
    </div>
@endif
 

<div class="form-group col-lg-12">
    {!! Form::label('Razón Social/Cliente (*) ')!!}
    {!! Form::text('RazonSocial',null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-lg-12">
    {!! Form::label('Nit/CI (*)')!!}
    {!! Form::text('Nit',null,['class'=>'form-control','required'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Teléfono')!!}
    {!! Form::text('Telefono',null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Dirección')!!}
    {!! Form::text('Direccion',null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Email')!!}
    {!! Form::text('CorreoElectronico',null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-lg-12">
    {!! Form::label('Foto')!!}
    {!! Form::file('Foto',null,['class'=>'form-control'])!!}
</div>
