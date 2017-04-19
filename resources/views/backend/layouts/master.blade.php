<!DOCTYPE html>
<html ng-app="myApp">
<head>
    @include('backend.layouts.head')
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" ng-controller="myController">

    <div class="wrapper">
        <!--HEADER -->
        <header class="main-header">
            <!-- Thông báo -->
            @if(session('success'))
                <div class="alert alert-success thongbao">
                    {{session('success')}}
                </div>
            @elseif(session('danger'))
                <div class="alert alert-danger thongbao">
                    {{session('danger')}}
                </div>
            @endif
            <!-- / Thông báo -->
            <!-- Logo -->
            <a href="{{url('/backend')}}" class="logo">
                <!-- mini logo -->
                <span class="logo-mini"><b>Y</b>M</span>
                <!-- logo -->
                <span class="logo-lg"><b>Angular</b>JS</span>
            </a>
            <!-- Nav -->
            @include('backend.layouts.nav')
            <!-- /Nav -->
    </header>
    <!--END HEADER-->

    <!-- ASIDE -->
        @include('backend.layouts.aside')
    <!--END ASIDE -->

    <!-- MAIN-->
    <div class="content-wrapper">
        
        <section class="main_master" ng-view>
            <!-- Main content -->
            @yield('content')

            <!-- /.content -->
        </section>
    </div>
    <!-- END MAIN -->

    <!-- FOOTER -->
    @include('backend.layouts.footer')
    <!-- END FOOTER -->

    <!-- Include script -->
    @yield('script')
    @include('backend.layouts.script')
    <!-- /script -->
    
</body>
</html>
