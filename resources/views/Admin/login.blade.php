@extends('layouts.master-without-nav')

@section('title') Login @endsection

@section('body')
<body>
    <div class="container-fluid">
        <div class="head">
            <div style="display: flex">
                <div><img src="http://bbq.dhi.mybluehost.me/congtyphuongdong.vn/wp-content/uploads/2019/10/logo-1024x324.png" width="200" ></div>
                <div class="flex">PHẦN DÀNH CHO QUẢN TRỊ WEBSITE</div>
            </div>
        </div>
    </div>
    <div class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <h2 class="text-center">Đăng nhập</h2>
                    <form class="login-form" method="POST" action="{{ route('post.login') }} " class="outer-repeater needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="text-uppercase " for="username">{{ __('Địa chỉ email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" equired  autofocus>
                           <!--  @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror -->
                            <div class="invalid-feedback"><em></em> <span class="title-message">Email không đúng định dạng </span></div>
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase " for="userpassword">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control"  name="password" value="{{ old('email') }}" required maxlength="8">
                           <!--  @error('password')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror -->
                            <div class="invalid-feedback"><em></em> <span class="title-message">Nhập mật khẩu  > 8 ký tự </span></div>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label" for="customControlInline">
                                <input type="checkbox" class="form-check-input" name="remember" id="customControlInline" checked>
                                <small>{{ __('Remember Me') }}</small>
                            </label>
                            <button type="submit" class="btn btn-login float-right" id="login">{{ __('Đăng nhập') }}</button>
                        </div>
                        <div class="mt-4 text-center">
                        {{-- <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> {{ __('Forgot Your Password?') }}</a> --}}
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p>Bạn chưa có tài khoản ? <a href="{{route('get.register')}}" class="font-weight-medium text-primary"> Đăng kí ngay </a> </p>
                    </div>
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
    <footer class="company_footer">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-sm-center d-none d-sm-block" style="margin-bottom: 30px;padding-top: 20px">
                    <span class="address">XÂY DỰNG VÀ PHÁT TRIỂN BỞI</span>
                    <span class="company_name"> CÔNG TY CÔ PHẦN CÔNG NGHỆ & GIẢI PHÁP PHƯƠNG ĐÔNG</span>
                    <span class="address">
                    Địa chỉ: Số 7, Ngách 75/46, Đường Phú Diễn, Phường Phú Diễn, Quận Bắc Từ Liêm, Thành phố Hà Nội </br>
                    VP : Lai Xá, Hoài Đức, Hà Nội </br>
                    Điện thoại: 033 8283 554 - Hotline: 0988 73 63 83 </br>
                    </span>
                    <a href="http://congtyphuongdong.vn">E-mail: ctyphuongdongvn@gmail.com</a>
                </div>
            </div>
        </div>
    </footer>

    @endsection
    <script >
        (function() {
        'use strict';
        window.addEventListener('load', function() {
 
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {

                    if (form.checkValidity() === true) {
                        event.preventDefault();
                        event.stopPropagation();
                    } 

                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        })();
    </script>