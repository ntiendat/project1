@extends('layouts.master-without-nav')

@section('title') Register @endsection

@section('body')

<body>
    @endsection

    @section('content')

    {{--<div class="home-btn d-none d-sm-block">--}}
        {{--<a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>--}}
    {{--</div>--}}
    {{--<div class="account-pages my-5 pt-sm-5">--}}
        {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<div class="col-md-8 col-lg-6 col-xl-5">--}}
                    {{--<div class="card overflow-hidden">--}}
                        {{--<div class="bg-login text-center">--}}
                            {{--<div class="bg-login-overlay"></div>--}}
                            {{--<div class="position-relative">--}}
                                {{--<h5 class="text-white font-size-20">Free {{ __('Register') }}</h5>--}}
                                {{--<p class="text-white-50 mb-0">Get your free Qovex account now</p>--}}
                                {{--<a href="index" class="logo logo-admin mt-4">--}}
                                    {{--<img src="/images/logo-sm-dark.png" alt="" height="30">--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="card-body pt-5">--}}

                            {{--<div class="p-2">--}}
                                {{--<form class="outer-repeater needs-validation" method="POST" action="{{ route('register') }}" novalidate>--}}
                                    {{--@csrf--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="useremail">{{ __('E-Mail Address') }}</label>--}}
                                        {{--<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="useremail" placeholder="Enter email" autocomplete="email">--}}
                                        {{--@error('email')--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@enderror--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="name">{{ __('Name') }}</label>--}}
                                        {{--<input type="text" name="name" value="{{ old('name') }}"  autocomplete="name" class="form-control @error('name') is-invalid @enderror" autofocus id="name" placeholder="Enter name">--}}
                                        {{--@error('name')--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@enderror--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="userpassword">{{ __('Password') }}</label>--}}
                                        {{--<input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" id="userpassword" placeholder="Enter password">--}}
                                        {{--@error('password')--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                            {{--<strong>{{ $message }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@enderror--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="userpassword">{{ __('Confirm Password') }}</label>--}}
                                        {{--<input type="password" name="password_confirmation" class="form-control" id="userconfirmpassword" placeholder="Confirm password">--}}
                                    {{--</div>--}}

                                    {{--<div class="mt-4">--}}
                                        {{--<button class="btn btn-primary btn-block waves-effect waves-light" id="register" type="submit"> {{ __('Register') }}</button>--}}
                                    {{--</div>--}}

                                    {{--<div class="mt-4 text-center">--}}
                                        {{--<p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="mt-5 text-center">--}}
                        {{--<p>Already have an account ? <a href="login" class="font-weight-medium text-primary"> Login</a> </p>--}}
                        {{--<p>© <script> document.write(new Date().getFullYear()) </script> Qovex. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    <style>
        .head{
            padding-top: 10px;
        }
        .flex{
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            color: #0056b3;
            width: 100%;
        }
        .login-block{
            background: #DE6262;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            float:left;
            width:100%;
            padding : 50px 0;
        }
        .banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
        .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
        .carousel-inner{border-radius:0 10px 10px 0;}
        .carousel-caption{text-align:left; left:5%;}
        .login-sec{padding: 50px 30px; position:relative;}
        .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#FEB58A;}
        .login-sec .copy-text a{color:#E36262;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
        .btn-login{background: #DE6262; color:#fff; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
        .banner-text p{color:#fff;}
    </style>

    <div class="container-fluid">
        <div class="head">
            <div style="display: flex">
                <div><img src="http://bbq.dhi.mybluehost.me/congtyphuongdong.vn/wp-content/uploads/2019/10/logo-1024x324.png" width="200" ></div>
                <div class="flex">CÔNG TY CỔ PHẦN CÔNG NGHỆ VÀ GIẢI PHÁP PHƯƠNG ĐÔNG</div>
            </div>
        </div>
    </div>
    <div class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <h2 class="text-center">Đăng kí</h2>
                    <form class="login-form" method="POST" action="{{ route('post.register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-uppercase">{{ __('Họ') }}</label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}"  autocomplete="firstname" class="form-control @error('firstname') is-invalid @enderror" autofocus id="firstname" placeholder="Nhập Họ...">
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="text-uppercase">{{ __('Tên') }}</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname" class="form-control @error('lastname') is-invalid @enderror" autofocus id="lastname" placeholder="Nhập Tên...">
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase" for="useremail">{{ __('Địa chỉ email') }}</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="useremail" placeholder="Nhập Email..." autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="userpassword" class="text-uppercase">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" id="userpassword" placeholder="Nhập Password...">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userpassword" class="text-uppercase">{{ __('Xác nhận password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="userconfirmpassword" placeholder="Xác Nhận Password...">
                             @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                           {{--  <span class="error-message" id="nameErr">{{$errors->first('password_confirmation')}}</span> --}}
                        </div>
                        <div class="form-check">
                            <button type="submit" class="btn btn-login float-right" id="register">{{ __('Đăng kí') }}</button>
                        </div>
                    </form>
                    <div>
                    <p>Bạn đã có tài khoản rồi ? <a href="{{route('get.login')}}" class="font-weight-medium text-primary"> Đăng nhập</a> </p>
                    </div>
                    <div class="copy-text">Tạo Bởi <i class="fa fa-heart"></i>Công Ty Phương Đông</div>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="{{ URL::asset('images/gioithieu.jpg')}}" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">
                                        <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('libs/metismenu/metismenu.min.js')}}"></script>
    <script src="{{ URL::asset('libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('libs/node-waves/node-waves.min.js')}}"></script>

    <script src="{{ URL::asset('js/app.min.js')}}"></script>

    @endsection
    @section('script')

    <!-- bootstrap datepicker -->
    <script src="{{ URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Summernote js -->
    <script src="{{ URL::asset('/libs/summernote/summernote.min.js')}}"></script>
    <!-- form repeater js -->
    <script src="{{ URL::asset('/libs/jquery-repeater/jquery-repeater.min.js')}}"></script>
    <script src="{{ URL::asset('/js/pages/task-create.init.js')}}"></script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {

               
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    @endsection