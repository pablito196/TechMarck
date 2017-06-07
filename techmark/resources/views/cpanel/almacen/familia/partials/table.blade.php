<table class="table table-striped">
    <thead>
    <tr>
        <th>IdFamilia</th>
        <th>Descripcion</th>
        <th>Fecha Modificacion</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($familias as $row)
        <tr>
            <td>{{$row->IdFamilia}}</td>
            <td>{{$row->Descripcion}}</td>
            <td>{{$row->FechaModificacion}}</td>
            <td>{{$row->usuario->NombreUsuario}}</td>
            <td>
                <a href="{{route('almacen.familia.edit',$row->IdFamilia)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>