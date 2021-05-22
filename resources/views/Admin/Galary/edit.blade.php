@extends('layouts.master')

@section('title') Sửa Galary @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.galary')}}">Danh sách Garary</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa Garary</a></li>
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
                          Garary
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation" method="POST" enctype="multipart/form-data" novalidate >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tiêu đề Garary (*)</label>
                           <input class="form-control" name="title" id="title" 
                           value="{{$galary->title}}" 
                           placeholder="Vui lòng nhập..." required maxlength="255" />
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <button type="button" id="selectmultiimage" class="btn btn-primary select-image">
                              Chọn ảnh
                            </button>
                            
                            <div id="div_albumb">
                                @foreach($galary_img as $galary_img)
                                    <div id="img_{{$galary_img->id}}" class="border-image-product" style="width:105px;height:105px;position:relative;display:inline-block;margin:5px 5px">
                                        <img id="media_id" name="media_id" src="{{asset('/Media/'.$galary_img->url)}}" style="margin-right:5px" alt="" width="100%" height="100%">
                                        <i class='fas fa-times' id="close_image" style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute' onclick='delete_image({{$galary_img->id}})' ></i>
                                    </div>
                                    <input type="hidden" value="{{$galary_img->url}}" id="url">
                                @endforeach
                                
                            </div> <br>
                        </div>
                        <div>
                             @include('Admin.modal-image');
                        </div>
                    </div>
                    <div class="col-sm-8 text-sm-center">
                        <input type="submit" id="submit-edit" class="btn btn-success"  value="Sửa Galary">
                       <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                </div>

                <form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <input type="hidden" name ="image_pro" value="{{$galary->media_id}}" id="image_pro">
        <!-- <input type="hidden" name="albumb_id[]" value="" id="albumb_id[]"> -->

        <input type="hidden" name="albumb_id" value="@foreach($galary_medias as $galary_media){{$galary_media->media_id}},@endforeach" id="albumb_id">

        <input type="hidden" value="{{$galary->id}}" id="galary_id" name="link_id">
@endsection
 @section('script')
        <!-- plugin js -->
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        //refest lai trang
                        event.preventDefault();
                        event.stopPropagation();

                        if (form.checkValidity() === true) {
                            saveUpdateGarary();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        function saveUpdateGarary(){
            // var media_id = $('#image_pro').val();
            var albumb = $('#albumb_id').val();
            var id = $('#galary_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update.galary') }}",
                data: {
                    title:$('#title').val(),
                    media_id: albumb,
                    id:id,

                },
                success:function (data) {
                    console.log(data['data']);
                    window.location.href='{{route('index.galary')}}';
                    //alert('Galary đã được sửa');
                    // data['success','oke'];
                },
                error: function(response) {
                    $('#titleErr').show();
                    $('#media_idErr').text(response.responseJSON.errors.media_id);
               }
            })
            return false;
        }
       $('#selectmultiimage').on('click',function(){
            $('#myModal').modal('show');
            isMultiSelected = true;
        })
    </script>
@endsection