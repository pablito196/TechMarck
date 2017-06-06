<table class="table table-striped">
    <thead>
    <tr>
        <th>IdAlmacen</th>
        <th>Descripcion</th>
        <th>Direccion</th>
        <th>Fecha Modificacion</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($almacenes as $row)
        <tr>
            <td>{{$row->IdAlmacen}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->Direccion}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{$row->usuario}}</td>
            <td>
                <a href="{{route('almacen.almacen.edit',$row->IdAlmacen)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>