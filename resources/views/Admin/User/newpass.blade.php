@extends('layouts.master')

@section('title') Sửa thông tin người dùng @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa mật khẩu</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sửa
                            mật khẩu
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">

                        <form class="outer-repeater needs-validation" action="{{route('update.password',['id'=>$user->id])}}" method="POST" novalidate oninput='passwordagain.setCustomValidity(passwordagain.value != passwordreset.value ? "Passwords do not match." : "")' >
                            <input type="hidden" name="id_hidden" id="id_hidden" value="{{$user->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            
                             <div class="form-group col-md-12"> 
                                <label>Mật khẩu cũ (*)</label>
                                <input class="form-control" type="password" id="password" name="password" required placeholder="Vui lòng nhập..." />
                                <div class="invalid-feedback"><em></em> <span class="title-message"> Nhập mật khẩu cũ </span></div>
                            </div>
                            <div class="form-group col-md-12">
                                {{-- <input type="checkbox" name="check" id="check" /> --}}
                                <label>Mật khẩu mới (*)</label>
                                <input type="password" class="form-control password" name="passwordreset" id="passwordreset" placeholder="Nhập mật khẩu"
                                  required minlength="6" maxlength="14" />
                                <div class="invalid-feedback"><em></em> <span class="title-message"> Nhập mật khẩu mới 6-14 ký tự </span></div>
                            </div>
                             <div class="form-group col-md-12">
                                <label>Nhập lại mật khẩu (*)</label>
                                <input type="password" class="form-control password" name="passwordagain" id="passwordagain" placeholder="Nhập lại mật khẩu"   required minlength="6" maxlength="14" />
                                <div class="invalid-feedback"><em></em> <span class="title-message"> Nhập lại mật khẩu mới 6-14 ký tự </span></div>
                            </div>
                            <div class="col-sm-8 text-sm-center">
                                <button type="submit" class="btn btn-success">Cập nhập</button>
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
