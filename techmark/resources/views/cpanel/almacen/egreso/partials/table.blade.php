<table class="table table-striped">
    <thead>
    <tr>
        <th>IdEgreso</th>
        <th>Articulo</th>
        <th>Almacen</th>
        <th>Cantidad</th>
        <th>Observaciones</th>
        <th>Fecha Egreso</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($egresos as $row)
        <tr>
            <td>{{$row->IdEgreso}}</td>
            <td>{{$row->articulo->Descripcion}}</td>
            <td>{{$row->almacen->Descripcion}}</td>
            <td>{{$row->Cantidad}}</td>
            <td>{{$row->Observacion}}</td>
            <td>{{$row->FechaEgreso}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.egreso.edit',$row->IdEgreso)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>