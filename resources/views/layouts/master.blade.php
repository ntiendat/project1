
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Công ty Phương Đông</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    {{-- <meta content="Themesbrand" name="author" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <meta http-equiv="Content-Security-Policy" content="script-src 'self' " /> --}}
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}">

    <!-- js thong bao them thanh cong -->
    <link rel="stylesheet" href="{{URL::asset('libs/noty/noty.min.css')}}">
    <script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
    <script src="{{URL::asset('libs/noty/noty.js')}}"></script>
    @include('layouts.head')
</head>
@section('body')
@show
<body data-layout="detached" data-topbar="colored" style="">
    @if (session('success'))
        <script>
            notify("<div style='font-size:15px'><i class='fa fa-check'></i> {{ session('success') }} </div>",'success');
        </script>
    @elseif(session('danger'))
        <script>
            notify("<div style='font-size:15px'><i class='fa fa-check'></i> {{ session('danger') }} </div>",'error');
        </script>
    @endif
    <style>
        @font-face {
            font-family:"materialdesignicons-webfont";
            src: url("/fonts/materialdesignicons-webfont.ttf") format("ttf"),
        }
    </style>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
               
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->


    <!-- Right Sidebar -->
@include('layouts.right-sidebar')
    <!-- /Right-bar -->
     @include('layouts.footer')
    <!-- JAVASCRIPT -->
    @include('layouts.footer-script')
</body>

</html>