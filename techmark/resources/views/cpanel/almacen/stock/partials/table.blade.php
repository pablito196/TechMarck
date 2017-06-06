<table class="table table-striped">
    <thead>
    <tr>
        <th>IdStock</th>
        <th>Almacen</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($haberes as $row)
        <tr>
            <td>{{$row->IdExistencia}}</td>
            <td>{{$row->Almacen}}</td>
            <td>{{$row->Articulo}}</td>
            <td>{{$row->cantidad}}</td>
            <td>
                <a href="{{route('almacen.stock.edit',$row->IdExistencia)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>