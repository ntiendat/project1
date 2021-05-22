@extends('layouts.master')

@section('title') Thêm người dùng @endsection

@section('content')
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.user')}}">Danh sách người dùng</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm người dùng</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
      </ol>
    </nav>
    
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm
                            người dùng
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form class="outer-repeater needs-validation" action="{{route('add.user')}}" method="POST" enctype="multipart/form-data" novalidate >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Họ (*)</label>
                                <input class="form-control" name="firstname" value="{{old('firstname')}}" placeholder="Vui lòng nhập..." required maxlength="255" />
                                <span class="error-message">{{ $errors->first('firstname') }}</span> 
                                <div class="invalid-feedback"><em></em> Nhập họ người dùng</div>
                            </div>
                            <div class="form-group">
                                <label>Tên (*)</label>
                                <input class="form-control" name="lastname" value="{{old('lastname')}}" placeholder="Vui lòng nhập..." required maxlength="255" />
                                <span class="error-message">{{ $errors->first('lastname') }}</span>
                                <div class="invalid-feedback"><em></em> Nhập tên người dùng</div>
                            </div>
                            <div class="form-group">
                                <label>Email (*)</label>
                                <input class="form-control" name="email" value="{{old('email')}}" placeholder="Vui lòng nhập..." required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="255" />
                                <span class="error-message">{{ $errors->first('email') }}</span>
                                <div class="invalid-feedback"><em></em> Email sai định dạng</div>
                            </div>
                            <div class="form-group">
                                <label>Password (*)</label>
                                <input class="form-control" name="password" value="" type="password" placeholder="Vui lòng nhập..." required minlength="6" maxlength="255" />
                                <span class="error-message">{{ $errors->first('password') }}</span>
                                <div class="invalid-feedback"><em></em> Mật khẩu ít nhất 6 kí tự</div>
                            </div>
                            <div class="col-sm-8 text-sm-center">
                                <button type="submit" class="btn btn-success">Thêm người dùng</button>
                                <button type="reset" class="btn btn-info">Nhập hết lại</button>
                            </div>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection




@section('script')

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