<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{url('dashboard')}}" class="logo">
            <i class="icon-c-logo"> <img src="{{url('logo.png')}}"  class="center-block img-responsive" style="max-height: 60px; margin-top: 25%"> </i>
            <span><img src="{{url('logo.png')}}"  class=" center-block img-responsive" style="max-height: 60px"/></span>
            </a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>
                <ul class="nav navbar-nav hidden-xs">
                    <li><a href="{{url('')}}" class="waves-effect waves-light">SISTEMA DE ADMINISTRACION CAINCO CHUQUISACA</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                    </li>
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><span>{{Auth::user()->nombre}}</span> <i class="caret"></i> </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('perfil.index')}}"><i class="ti-user m-r-10 text-custom"></i> Perfil</a></li>
                            <li class="divider"></li>
                            <li><a href="{{url('logout')}}"><i class="ti-power-off m-r-10 text-danger"></i> Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
