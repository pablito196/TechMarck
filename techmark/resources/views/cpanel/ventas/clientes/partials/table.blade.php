<table class="table table-striped">
    <thead>
    <tr>
        <th>Id Cliente</th>
        <th>Nombre o Razon Social</th>
        <th>Nit</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Email</th>
        <th>Fecha de Modificación</th>
        <th>Id Usuario</th>
        <th>Foto</th>
        <th>Acciones</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($clientes as $row)
        <tr>
            <td>{{($row->IdCliente)}}</td>
            <td>{{($row->RazonSocial)}}</td>
            <td>{{$row->Nit}}</td>
            <td>{{($row->Telefono)}}</td>
            <td>{{$row->Direccion}}</td>
            <td>{{($row->CorreoElectronico)}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{($row->IdUsuario)}}</td>
            <td>
                <img src="{{asset('imagenes/clientes/'.$row->Foto)}}" alt="{{$row->Foto}}" height="100px" width="100px" class="img-thumbnail">

            </td>
            <td>
        
                <a href="{{route('ventas.cliente.edit',$row->IdCliente)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>