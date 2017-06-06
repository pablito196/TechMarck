<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

                <li class="text-muted menu-title">Navegacion</li>

                <li class="has_sub">
                    <a href="{{url('dashboard')}}" class="waves-effect"><i class="ti-home"></i> <span> Inicio </span> </a>

                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">1</span> <span> Usuarios & Cargos </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('admin.usuario.index')}}">Usuarios</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">1</span> <span> Almacen </span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('almacen.articulo.index')}}">Articulos</a></li>
                    </ul>
                </li>
                
                 <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-people"></i><span class="label label-primary pull-right">2</span> <span> Clientes & Visitas</span>  </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('ventas.cliente.index')}}">Clientes</a></li>
                        <li><a href="{{route('ventas.visita.index')}}">Visitas</a></li>
                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>