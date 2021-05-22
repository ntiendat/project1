@extends('layouts.master')
@section('content')
@section('title') Sửa Slide @endsection
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li  class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.slide')}}">Danh sách slide</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa Slide</a></li>
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
                    Slide
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12 col-md" >
                <form  method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                   {{--  <div class="form-group">
                        <label>Tên slide</label>
                        <input class="form-control" name="name" id="name" value="{{$slide->name}}" placeholder="Vui lòng nhập..." />
                        <span class="error-message" id="nameErr"></span>
                    </div> --}}
                    <div class="form-group">
                        <label>URL</label>
                        <input class="form-control" name="url" id="url" value="{{$slide->url}}" placeholder="Vui lòng nhập..." />
                        <span class="error-message" id="urlErr"></span>
                    </div>
                    <div class="form-group">
                        <label>Ảnh slide</label>
                        <button type="button" id="selectoneimage" class="btn btn-primary">
                        Chọn ảnh
                        </button>
                        <br><br>
                        <div id="div_albumb">
                            <div id="img_thumb" style="width:100%;height:120px;position:relative;display:inline-block;">
                                @if (isset($slide->Media))
                                <img id="img_product" name="img_product" src="{{asset('Media/'.$slide->Media->url)}}" style="margin-right:5px" alt="" width="120px" height="120px">
                                <a class="delete_image_box"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;cursor: pointer;' ></i></a>
                                @else 
                                <img id="img_product" name="img_product" style="margin-right:5px" alt="" width="120px" height="120px">
                                <a class="delete_image_box"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;cursor: pointer;' ></i></a>
                                @endif
                            </div>
                        </div>
                          <span class="error-message" id="media_imgErr">{{ $errors->first('media_img') }}</span>
                        
                    </div>
                @include('Admin.modal-image');
         
</div>
</div>
</div>

<div class="col-sm-8 text-sm-center">
    <input type="button" id="submit-edit-slide" class="btn btn-success"  value="Sửa slide">
</div>
{{-- <button type="submit" class="btn btn-success">Sửa Slide</button> --}}
{{-- <button type="reset" class="btn btn-info">Reset</button> --}}
<form>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>


<input type="hidden" id="image_pro" value="{{$slide->media_id}}"> 
<input type="hidden" id="hidden_id" value="{{$slide->id}}"> 
@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script>

        $('#submit-edit-slide').on('click',function(){
            var name = $('#name').val();
            var url = $('#url').val();
            var media_id = $("#image_pro").val();
            var id =  $("#hidden_id").val();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update.slide') }}",
                data: {
                    name:name,
                    url:url,
                    media_id:media_id,
                    id:id,
                },
                success:function (data) {
                    window.location.href ='{{route('index.slide')}}';
                    // alert('Sửa slide thành công');
                },
                error: function (response) {
                    $('#nameErr').text(response.responseJSON.errors.name);
                    $('#urlErr').text(response.responseJSON.errors.url);
                    $('#media_imgErr').text(response.responseJSON.errors.media_img);
                }
            })
            return false;
        })

        // 
    </script>
@endsection


