<table class="table table-striped">
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Articulo</th>
        <th>Almacen</th>
        <th>Cantidad</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($haberes as $row)
        <tr>
            <td>{{$row->Codigo}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>
                @foreach($row->stock as $stock)
                {{$stock->almacen->Descripcion}}
                <br>
                @endforeach
            </td>
            <td>
                @foreach($row->stock as $stock)
                {{$stock->CantidadExistente}}
                <br>
                @endforeach
            </td>
            <td>
                @foreach($row->stock as $stock)
                <a href="{{route('almacen.stock.edit',$stock->IdExistencia)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
                <br>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>