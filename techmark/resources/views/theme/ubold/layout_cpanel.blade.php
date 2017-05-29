<!DOCTYPE html>
<html>
<head>
    @include('theme.ubold.partials.css')

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
        @include('theme.ubold.partials.top-bar')
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
   {{--  @can('isAdmin',Auth::user()->rol)
        @include('theme.ubold.sidebar.admin')
    @endcan
    @can('isConcesionario',Auth::user()->rol)
    @include('theme.ubold.sidebar.empresa')
    @endcan
    --}}
    @include('theme.ubold.sidebar.admin')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                @yield('content')

            </div> <!-- container -->

        </div> <!-- content -->

        @include('theme.ubold.partials.footer')

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->





</div>
<!-- END wrapper -->

@include('theme.ubold.partials.js')

</body>
</html>