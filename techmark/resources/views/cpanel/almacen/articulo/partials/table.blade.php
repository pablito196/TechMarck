<table class="table table-striped">
    <thead>
    <tr>
        <th>IdArticulo</th>
        <th>Descripcion</th>
        <th>Familia</th>
        <th>Medida</th>
        <th>Marca</th>
        <th>Tipo Articulo</th>
        <th>Fecha Modificacion</th>
        <th>Usuario</th>
        <th>Codigo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $row)
        <tr>
            <td>{{$row->IdArticulo}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->familia->Descripcion}}</td>
            <td>{{$row->medida->Descripcion}}</td>
            <td>{{$row->marca->Descripcion}}</td>
            <td>{{$row->tipoarticulo->Descripcion}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>{{$row->Codigo}}</td>
            <td>
                <a href="{{route('almacen.articulo.edit',$row->IdArticulo)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>