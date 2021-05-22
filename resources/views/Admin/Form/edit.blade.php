@extends('layouts.master')
@section('content')
@section('title') Sửa form @endsection
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.form')}}">Danh sách form</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa form</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
</ol>
</nav>
<style type="text/css">
    .error-message { color: red; }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                    form
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12 col-md" >
                <form class="outer-repeater needs-validation"   method="POST"  action="{{route('update.form',$form->id)}}" novalidate >
                    @csrf
                    {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                    <div class="form-group">
                        <label>Email nhận (*)</label>
                        <input class="form-control" name="email_to" id="email_to" value="{{$form->email_to}}" placeholder="Vui lòng nhập..." required />
                        <span class="error-message" id="nameErr">{{$errors->first('email_to')}}</span>
                        <div class="invalid-feedback"><em></em> Email sai định dạng</div>

                    </div>
                    <div class="form-group">

                        <label>Tên form (*)</label>
                        <input class="form-control" name="name" id="name" value="{{$form->name}}" placeholder="Vui lòng nhập..." required />

                        <span class="error-message" id="nameErr">{{$errors->first('name')}}</span>
                        <div class="invalid-feedback"><em></em> Nhập tên Form</div>
                    </div>
                    <div class="form-group">
                        <label>Gía trị</label>
                        <textarea name="value" id="content" rows="10">{{$form->value}}"</textarea>
                        <span class="error-message" id="valueErr">{{$errors->first('value')}}</span>
                    </div>
                    {{-- <button type="submit" class="btn btn-success">Sửa Form</button> --}}
                    <div class="col-sm-8 text-sm-center">
                    <input type="submit" id="btn-send-email" class="btn btn-primary" value="Sửa form" />
                    <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

