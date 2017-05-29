<table class="table table-striped">
    <thead>
    <tr>
        <th>Nombre Usuario</th>
        <th>password encriptado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $row)
        <tr>
            <td>{{($row->NombreUsuario)}}</td>
            <td>{{$row->password}}</td>
            <td>
                <a href="{{route('admin.usuario.edit',$row->IdUsuario)}}">Ver & Editar <i class="fa fa-edit"></i> </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>