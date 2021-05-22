@extends('layouts.master')

@section('title') Sửa loại danh mục @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        @if($category->type == 3)
            <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('index.categoryimage',3)}}">Danh sách loại ảnh</a></li>
        @else
            <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('index.categoryvideo',4)}}">Danh sách loại video</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa lại danh mục</a></li>
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
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Sửa
                            loại danh mục
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form action="{{route('update.category',['id'=>$category->id])}}" method="POST" enctype="multipart/form-data" class="outer-repeater needs-validation" novalidate >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <div class="form-group">
                                <label>Tên danh mục</label>
                               <input class="form-control" name="name" placeholder="Vui lòng nhập..." value=" @if(old('name')){{old('name')}} @else {{$category->name}} @endif" required maxlength="255" />
                               <!-- <span class="error-message">{{ $errors->first('name') }}</span> -->
                                <div class="invalid-feedback"><em></em> Tên danh mục không được để trống</div>
                            </div>
                            <div class="form-group">
                                <label>Miêu tả</label>
                                <textarea name="desc" class="form-control" id="content" rows="10" > @if(old('desc')){{old('desc')}} @else {{$category->desc}} @endif</textarea>
                                <span class="error-message">{{ $errors->first('desc') }}</span>
                            </div>
                            <input type="hidden" name="type" value="{{$type}}">
                            <div class="col-sm-8 text-sm-center">
                            <button type="submit" class="btn btn-success">Sửa</button>
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
        <!-- plugin js -->
        <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
        
        <!-- jquery.vectormap map -->
        <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
        
        <!-- Calendar init -->
        <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
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