<table class="table table-striped">
    <thead>
    <tr>
        <th>IdMedida</th>
        <th>Descripcion</th>
        <th>Fecha Modificacion</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medidas as $row)
        <tr>
            <td>{{$row->IdMedida}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.medida.edit',$row->IdMedida)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>