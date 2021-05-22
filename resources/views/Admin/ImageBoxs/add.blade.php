@extends('layouts.master')
@section('title') Thêm Image Box @endsection
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
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.image.box')}}">Danh sách image box</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm Image Box</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm Image Box
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation" action="{{route('add.image.box')}}" method="POST" enctype="multipart/form-data" novalidate >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tiêu đề (*)</label>
                           <input class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Vui lòng nhập..." required maxlength="250" />
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Miêu tả</label>
                            <textarea name="description" value="{!!old('description')!!}" class="form-control" id="description" rows="5" ></textarea>
                            <!-- <span class="error-message" id="descriptionErr">{{ $errors->first('description') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <button type="button" id="selectoneimage" class="btn btn-primary select-image">
                              Chọn ảnh
                            </button>
                            <div id="div_albumb" name="div_albumb" style="padding-top: 20px">
                                 <div id="img_thumb" style="width:200px;height:200px;position:relative;display:none;">
                                    <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                                    <a class="delete_image_box">
                                        <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                    </a>
                                </div>
                            </div><br>
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input class="form-control" name="url" id="url" value="{{old('url')}}" placeholder="Vui lòng nhập..." />
                        </div>
                        <div>
                             @include('Admin.modal-image');
                        </div>
                        <div class="form-group">
                            <label for="project-priority">Danh mục image box</label>

                            <select class="select2 form-control select2"  data-placeholder="Choose ..." id="category_id" name="category_id" >
                                <option selected value="0">Danh mục cha</option>
                                @foreach ($category as $key => $value)
                                
                                    <option value="{{ $value['id'] }}"
                                       
                                    >{{$value['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    {{-- @include('Admin.right-col-image-box') --}}
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

@section('script')
        <!-- plugin js -->
    {{-- <script>
        

        $('#btn-add-cate').on('click',function(){
            var name = $('#name_cate_input').val();
            var parent_id = $('select[name=parent_id] option').filter(':selected').val();
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('add.category.image.box') }}",
                data: {
                    name: name,
                    parent_id: parent_id
                },
                success:function (data) {
                    if(parent_id == 0){
                        $('#myUL').append("<li id='cate" + data['id'] + "' class='nested active'><span class='caret'><input type='checkbox' id='category_id' name='' value='"+data['id']+"'>" + name + "</span><ul class='nested active'></ul></li>");
                    }else{
                        $('#cate'+ parent_id).append("<ul id='cate" + data['id'] + "' class='nested active'><li><span class='caret'><input type='checkbox' id='category_id' name='' value='"+data['id']+"'>" + name + "</span></li></ul>");
                        var char = '--';
                        $('#link_id').val(data['id']);
                    }
                },
                error: function (response) {
                    // console.log(error);
                     $('#name_cateErr').text(response.responseJSON.errors.name);
                }

                
            })
        });
    </script> --}}
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
                            saveImageBox();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function saveImageBox(){
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
                url: "{{ route('add.image.box') }}",
                data: {
                    title:$('#title').val(),
                    description:description,
                    media_id: media_id,
                    category: category_id,
                    url: url,
                },
                success:function (data) {
                    console.log(data['data']);
                    window.location.href ='{{route('index.image.box')}}';
                    //alert('Image Box đã được thêm');
                    // data['success','oke'];
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

@endsection

