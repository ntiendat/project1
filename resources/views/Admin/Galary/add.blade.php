@extends('layouts.master')
@section('title') Thêm Galary @endsection
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
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.galary')}}">Danh sách Galary</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm Galary</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm Galary
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation"  method="POST" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tiêu đề (*)</label>
                           <input class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Vui lòng nhập..." / required maxlength="255">
                           <!-- <span class="error-message" id="titleErr" style="display:none;"><em class="icon-error"></em> Tiêu đề không đúng</span> -->
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <button type="button" id="selectmultiimage" class="btn btn-primary select-image">
                              Chọn ảnh
                            </button>
                            <div class="col-12">
                            <div id="div_albumb" style="display: inline-block;margin-left: 50px">
                            </div>
                            </div>
                        </div>
                        <div>
                            @include('Admin.modal-image');
                           {{-- @include('Admin.right-col-image-box') --}}
                        </div>
                        
                   
                    <div class="col-sm-8 text-sm-center">
                        <input type="submit" id="submit-add" class="btn btn-success"  value="Thêm Galary">
                        <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                    
                </div>
                <form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
       {{--  <input type="hidden" name ="image_pro" value="" id="image_pro"> --}}
        <input type="hidden" name="albumb_id" value="" id="albumb_id">
        <input type="hidden" value="" id="link_id" name="link_id">
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
                            saveGarary();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function saveGarary(){
            // var media_id = $('#image_pro').val();
            var albumb = $('#albumb_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('add.galary') }}",
                data: {
                    title:$('#title').val(),
                    media_id: albumb,
                },
                success:function (data) {
                    console.log(data['data']);
                    window.location.href ='{{route('index.galary')}}';
                    //alert('Galary đã được thêm');
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

