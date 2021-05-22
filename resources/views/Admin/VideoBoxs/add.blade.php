@extends('layouts.master')
@section('title') Thêm Video Box @endsection
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
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.video.box')}}">Danh sách video box</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm Video Box</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm video box
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation" action="{{route('add.video.box')}}" method="POST" enctype="multipart/form-data" novalidate >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tiêu đề (*)</label>
                           <input class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Vui lòng nhập..." required />
                          <!--  <span class="error-message" id="titleErr" style="display:none;"><em class="icon-error"></em> Tiêu đề không đúng</span> -->
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề Video không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Miêu tả</label>
                            <textarea name="description" value="{!!old('description')!!}" class="form-control" id="description" rows="5" ></textarea>
                            <!-- <span class="error-message" id="descriptionErr">{{ $errors->first('description') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn (*)</label>
                            <input class="form-control" name="url" id="url" value="{{old('url')}}" placeholder="Vui lòng nhập..." required="" maxlength="500" />
                              <div class="invalid-feedback"><em></em> <span class="title-message">Đường dẫn không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label for="project-priority">Danh mục image box</label>
                            <select class="select2 form-control select2"  data-placeholder="Choose ..." id="category_id" name="category_id" >
                                <option value="0">Danh mục cha</option>
                                @foreach ($category as $key => $value)
                                    <option value="{{ $value['id'] }}"
                                        
                                    >{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                    <div class="col-sm-8 text-sm-center">
                        <input type="submit" id="submit-add-pro" class="btn btn-success"  value="Thêm Image Box">
                        <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                    
                </div>
                <form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <input type="hidden" name ="image_pro" value="" id="image_pro">
        <input type="hidden" name="albumb_id" value="" id="albumb_id">
        <input type="hidden" value="" id="link_id" name="link_id">
@endsection

@section('script-bottom')
    <script>
        //chọn 1 
        // $("input:checkbox").on('click', function() {
        //     var $box = $(this);
        //     if ($box.is(":checked")) {
               
        //         var group = "input:checkbox[name='" + $box.attr("name") + "']";
                
        //         $(group).prop("checked", false);
        //         $box.prop("checked", true);
        //     } else {
        //         $box.prop("checked", false);
        //     }
        // });
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
                            saveVideoBox();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        function saveVideoBox(){
            var description = $('#description').val();
            var media_id = $('#image_pro').val();
            var category_id = $("#category_id").val(); 
            var url = $("#url").val(); 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('add.video.box') }}",
                data: {
                    title:$('#title').val(),
                    description:description,
                    media_id: media_id,
                    category: category_id,
                    url: url,
                },
                success:function (data) {
                    console.log(data['data']);
                    window.location.href ='{{route('index.video.box')}}';
                },
                error: function(response) {
                    $('#titleErr').show();
                    $('#contentErr').text(response.responseJSON.errors.content);
                    $('#product_media_idErr').text(response.responseJSON.errors.product_media_id);
                    $('#category_idErr').text(response.responseJSON.errors.category);
                    $('#media_idErr').text(response.responseJSON.errors.media_id);
                    $('#parent_idErr').text(response.responseJSON.errors.parent_id);
               }
            })
            return false;
        }
        $('#selectmultiimage').on('click',function(){
            $('#myModal').modal('hidden');
            isMultiSelected = true;
        })
    </script>
    <script>
         $('#add_video').on('click',function(){
           window.location.reload();
        }); 
    </script>
@endsection

