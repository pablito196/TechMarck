<table class="table table-striped">
    <thead>
    <tr>
        <th>IdIngreso</th>
        <th>Articulo</th>
        <th>Almacen</th>
        <th>Cantidad</th>
        <th>Observaciones</th>
        <th>Fecha Ingreso</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ingresos as $row)
        <tr>
            <td>{{$row->IdIngreso}}</td>
            <td>{{$row->articulo->Descripcion}}</td>
            <td>{{$row->almacen->Descripcion}}</td>
            <td>{{$row->Cantidad}}</td>
            <td>{{$row->Observacion}}</td>
            <td>{{$row->FechaIngreso}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.ingreso.edit',$row->IdIngreso)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>