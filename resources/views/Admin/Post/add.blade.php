@extends('layouts.master')
@section('title') Thêm bài viết @endsection
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
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm bài viết</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                            bài viết
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation" novalidate method="POST" enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="form-group">
                           <label>Tiêu đề bài viết (*)</label>
                           <input class="form-control" maxlength="255" name="title" id="title" value="{{old('title')}}" placeholder="Vui lòng nhập..." required maxlength="255" />
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề bài viết không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="content" value="{!!old('content')!!}" class="form-control" id="content" rows="10" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Bình luận bài viết </label>
                             <select name="allow_comment" id="allow_comment" class="form-control">
                                <option value="1">Được bình luận</option>
                                <option value="2">Khóa bình luận</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bài Viết or Trang </label>
                            <select name="type" id="type" class="form-control">
                                <option value="0">Bài viết</option>
                                <option value="1">Trang</option>
                            </select>
                        </div>
                    </div>
                    @include('Admin.right-col-post')
                    <div class="col-sm-8 text-sm-center">
                        <input type="submit" id="submit-add-pro" class="btn btn-success"  value="Thêm bài viết">
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
                            savePost();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();


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
                url: "{{ route('add.category.post') }}",
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
    </script>
    <script>

        function savePost() { 

            var content = CKEDITOR.instances['content'].getData();
            var media_id = $('#image_pro').val();
            var albumb = $('#albumb_id').val();
            var tag = $("#tag_id").val();
            var list = [];
            $('ul#myUL').find("input:checkbox:checked").each(function () {
                list.push($(this).val());
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('add.post') }}",
                data: {
                    title:$('#title').val(),
                    content:encodeURIComponent(content),
                    allow_comment:$('#allow_comment').val(),
                    type:$('#type').val(),
                    media_id: media_id,
                    category: list,
                    tag: tag
                },
                success:function (data) {
                    console.log(data['data']);
                    //alert('Thêm bài viết or trang thành công');
                    window.location.href ='{{route('index.post')}}';
                    // data['success','oke'];
                },
                error: function(response) {
                   console.log(response)

                    $('#contentErr').text(response.responseJSON.errors.content);
                    $('#product_media_idErr').text(response.responseJSON.errors.product_media_id);
                    $('#category_idErr').text(response.responseJSON.errors.category);
                    $('#media_idErr').text(response.responseJSON.errors.media_id);
                    $('#tag_idErr').text(response.responseJSON.errors.tag);
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

