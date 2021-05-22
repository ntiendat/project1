@extends('layouts.master')

@section('title') Sửa thẻ tag @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.tag.product')}}">Danh sách tag</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa Tag</a></li>
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
                    <h1 class="page-header"style=" margin: 56px 0 20px;">Sửa
                        Tag
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12 col-md" style="padding-bottom:120px">
                    <form class="outer-repeater needs-validation" action="{{route('update.tag.product',['id'=>$tag->id])}}" method="POST" enctype="multipart/form-data" novalidate >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên thẻ (*)</label>
                            <input class="form-control" name="name" placeholder="Vui lòng nhập..." value="@if(old('name')){{old('name')}} @else {{$tag->name}} @endif" required maxlength="255" />
                            <span class="error-message">{{ $errors->first('name') }}</span>
                             <div class="invalid-feedback"><em></em> <span class="title-message">Tên thẻ không được để trống </span></div>
                        </div>
                        <div class="col-sm-8 text-sm-center">
                            <button type="submit" class="btn btn-success">Sửa Tag</button>
                        <div class="col-sm-8 text-sm-center">
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

