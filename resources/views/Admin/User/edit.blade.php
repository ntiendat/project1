@extends('layouts.master')

@section('title') Sửa thông tin người dùng @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.user')}}">Danh sách người dùng</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa thông tin người dùng</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa
                            thông tin người dùng
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form class="outer-repeater needs-validation" action="{{route('update.user',['id'=>$user->id])}}" method="POST" novalidate  >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Họ (*)</label>
                                <input class="form-control" name="firstname" placeholder="Vui lòng nhập..." value=" @if(old('firstname')){{old('firstname')}} @else {{$user->firstname}} @endif" required  maxlength="255"/>
                                <span class="error-message">{{$errors->first('firstname') }}</span>
                                <div class="invalid-feedback"><em></em> Nhập họ người dùng</div>
                            </div>
                             <div class="form-group">
                                <label>Tên (*)</label>
                                <input class="form-control" name="lastname" placeholder="Vui lòng nhập..." value=" @if(old('lastname')){{old('lastname')}} @else {{$user->lastname}} @endif" required maxlength="255" />
                                
                                <span class="error-message">{{ $errors->first('lastname') }}</span>
                                <div class="invalid-feedback"><em></em> Nhập tên người dùng</div>
                            </div>
                            <div class="form-group">
                                <label>Email (*)</label>
                                <input class="form-control" name="email" placeholder="Vui lòng nhập..." readonly value=" @if(old('email')){{old('email')}} @else {{$user->email}} @endif" required maxlength="255" />
                                <span class="error-message">{{ $errors->first('email') }}</span>
                                <div class="invalid-feedback"><em></em> Email sai định dạng</div>
                            </div>
                             <div class="form-group">
                                <label>Tạo lại mật khẩu</label>
                                <input type="button" class="btn btn-danger" value="Reset password" id="resetpassword">
                            </div>
                            <div class="col-sm-8 text-sm-center">
                                <button type="submit" class="btn btn-success">Sửa thông tin</button>
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
     
        <script type="text/javascript">
    $(document).ready(function(){
       $("#check").change(function(){
           if($(this).is(":checked"))
           {
            $(".password").removeAttr('disabled');
           }
           else
           {
            $(".password").attr('disabled','');
           }
       });

    });

</script>
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