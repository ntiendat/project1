@extends('layouts.master')
@section('title') Thêm trang @endsection
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.post')}}">Danh sách bài viết</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm trang</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                            trang
                        </h1>
                    </div>
                </div>
                <form action="{{route('add.page.post')}}" method="POST" enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Tiêu đề trang</label>
                           <input class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Vui lòng nhập..." />
                           <span class="error-message" id="titleErr">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="content" value="{{old('content')}}" class="form-control" id="content" rows="10" ></textarea>
                            <!-- <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span> -->
                        </div>
                       
                    </div>
                    <input type="submit"  class="btn btn-success"  value="Thêm trang">
                    <button type="reset" class="btn btn-info">Reset</button>
                </div>
                <form>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        </div>
@endsection


