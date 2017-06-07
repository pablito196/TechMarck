<table class="table table-striped">
    <thead>
    <tr>
        <th>Descripcion</th>
        <th>Direccion</th>
        <th>Articulos</th>
        <th>Stock</th>
        <th>Fecha Modificacion</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($almacenes as $row)
        <tr>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->Direccion}}</td>
            <td>
                @foreach($row->stock as $stock)
                {{$stock->articulo->Descripcion}}
                <br>
                @endforeach
            </td>
            <td>
                @foreach($row->stock as $stock)
                {{$stock->CantidadExistente}}
                <br>
                @endforeach
            </td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.almacen.edit',$row->IdAlmacen)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>