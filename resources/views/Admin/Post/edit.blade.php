@extends('layouts.master')

@section('title') Sửa bài viết @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.post')}}">Danh sách bài viết</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa bài viết</a></li>
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
                          bài viết
                        </h1>
                    </div>
                </div>
                <form method="POST" class="outer-repeater needs-validation" novalidate enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="form-group">
                            <label>Tiêu đề bài viết (*)</label>
                           <input class="form-control" name="title" id="title" 
                           value="{{$post->title}}" 
                           placeholder="Vui lòng nhập..." maxlength="255" required />
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề bài viết không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="content" class="form-control" id="content" rows="10" >{{$post->content}}</textarea>
                            <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Bình luận bài viết </label>
                             <select name="allow_comment" id="allow_comment" class="form-control">
                                @if($post->allow_comment == 1)
                                <option value="1" selected="">Được bình luận</option>
                                <option value="2">Khóa bình luận</option>
                                @else
                                 <option value="1" >Được bình luận</option>
                                <option value="2" selected="">Khóa bình luận</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bài Viết or Trang </label>
                             <select name="type" id="type" class="form-control">
                                @if($post->type == 1)
                                    <option value="0">Bài viết</option>
                                    <option value="1" selected="">Trang</option>
                                @else
                                    <option value="0" selected="">Bài viết</option>
                                    <option value="1" >Trang</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    @include('Admin.right-col-edit-post')
                    <div class="col-sm-8 text-sm-center">
                        <input type="submit" id="submit-edit-post" class="btn btn-success"  value="Sửa bài viết">
                        <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                </div>
                <form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <input type="hidden" name ="image_pro" value="{{$post->media_id}}" id="image_pro">
        <input type="hidden" name="albumb_id" value="" id="albumb_id">
        <input type="hidden" value="{{$post->id}}" id="post_id" name="link_id">
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
                         event.preventDefault();
                         event.stopPropagation();
                        if (form.checkValidity() === true) {
                           updatePost();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

       


        $('#btn-add-cate').on('click',function(){

            var name = $('#name-cate-input').val();

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
                     $('#name_cateErr').text(response.responseJSON.errors.name);
                }
            })
        });

        function updatePost() {
            var content = CKEDITOR.instances['content'].getData();
            var media_id = $('#image_pro').val();
            var albumb = $('#albumb_id').val();
            var tag = $("#tag_id").val();
            var id = $("#post_id").val();
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
                url: "{{ route('update.post') }}",
                data: {
                    title:$('#title').val(),
                    content: encodeURIComponent(content),
                    allow_comment:$('#allow_comment').val(),
                    type:$('#type').val(),
                    media_id: media_id,
                    category: list,
                    tag: tag,
                    id: id,
                },
                success:function (data) {
                    window.location.href ='{{route('index.post')}}';
                    
                },
                error: function(response) {
                    $('#titleErr').show();
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