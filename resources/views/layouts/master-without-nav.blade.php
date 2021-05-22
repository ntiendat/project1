<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title> @yield('title') | Công ty Phương Đông</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}">
    <link rel="stylesheet" href="{{URL::asset('libs/noty/noty.min.css')}}">
    <script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
    <script src="{{URL::asset('libs/noty/noty.js')}}"></script>
    @include('layouts.head')
</head>
@yield('body')
<body>
<div>
    @if (session('success'))
        <script>
            notify("<div style='font-size:15px'><i class='fa fa-check'></i> {{ session('success') }} </div>", 'success');
        </script>
    @elseif(session('danger'))
        <script>
            notify("<div style='font-size:15px'><i class='fa fa-check'></i> {{ session('danger') }} </div>", 'error');
        </script>
    @endif
</div>

@yield('content')

@include('layouts.footer-script')
</body>
</html>
