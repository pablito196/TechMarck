<table class="table table-striped">
    <thead>
    <tr>
        <th>IdMarca</th>
        <th>Descripcion</th>
        <th>Fecha Modificacion</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($marcas as $row)
        <tr>
            <td>{{$row->IdMarca}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.marca.edit',$row->IdMarca)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>