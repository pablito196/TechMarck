<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{Config::get('cpanel.descripcion')}}">
<meta name="author" content="{{Config::get('cpanel.autor')}}">

<link href="{{url('icon.png')}}" type="image/x-icon" rel="shortcut icon">
<title>{{Config::get('cpanel.titulo')}}</title>

@yield('css')

<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />

<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<script src="{{url('assets/js/modernizr.min.js')}}"></script>
<style>
    input[type='number'] {
        -moz-appearance:textfield;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>