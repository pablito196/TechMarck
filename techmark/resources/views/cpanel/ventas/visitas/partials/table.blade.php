<table class="table table-striped">
    <thead>
    <tr>
        <th>Id Cliente</th>
        <th>Nombre Cliente</th>
        <th>Fecha Agendada</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Usuario</th>
        <th>Fecha de Modificación</th>
        <th>FechaVisitada</th>
        <th>Acciones</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach($visitas as $row)
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
        
                <a href="{{route('ventas.visita.edit',$row->IdVisita)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>