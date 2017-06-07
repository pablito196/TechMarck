<table class="table table-striped">
    <thead>
    <tr>
        <th>IdTipoArticulo</th>
        <th>Descripcion</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tipoarticulos as $row)
        <tr>
            <td>{{$row->IdTipoArticulo}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.tipoarticulo.edit',$row->IdTipoArticulo)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>