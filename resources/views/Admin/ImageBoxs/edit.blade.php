@extends('layouts.master')

@section('title') Sửa Image box @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.image.box')}}">Danh sách Image box</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa Image box</a></li>
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
                          Image box
                        </h1>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data" class="outer-repeater needs-validation" novalidate >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tiêu đề Image box(*)</label>
                           <input class="form-control" name="title" id="title" 
                           value="{{$galary->title}}" 
                           placeholder="Vui lòng nhập..." required maxlength="250" />
                            <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="description" class="form-control" id="description" rows="5" >{{$galary->description}}</textarea>
                            <span class="error-message" id="descriptionErr">{{ $errors->first('description') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <button type="button" id="selectoneimage" class="btn btn-primary select-image">
                              Chọn ảnh
                            </button>
                            <div id="div_albumb" style="padding-top: 20px">
                                @if ($galary_img == null)
                                    <div id="img_thumb" style="width:200px;height:200px;position:relative;display:none;">
                                        <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                                        <a class="delete_image_box">
                                            <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                        </a>
                                    </div>
                                @else 
                                    <div id="img_thumb" style="width:200px;height:200px;position:relative;display:inline-block;">
                                        <img id="img_product" name="img_product" src="{{asset('Media/'.$galary_img->url)}}" style="margin-right:5px" alt="" width="100%" height="120px">
                                        <a class="delete_image_box"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;cursor: pointer;' ></i>
                                        </a>
                                        
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input class="form-control" name="url" id="url" value="{{$galary->url}}" placeholder="Vui lòng nhập..." />
                        </div>
                        <div>
                            @include('Admin.modal-image');
                        </div>
                        {{-- <div>
                            <div class="div-right" style="">
                                <p class="name-cate" style=" ">Tất cả danh mục</p>
                                <div style="margin-left: 5px;border-bottom: 1px solid">  
                                   <ul id="myUL">
                                    <?php
                                        $cate_check = array_column($category_old->toArray(),'category_id');
                                        //var_dump($cate_check);

                                        buildCategory($category,0,$cate_check);
                                        function buildCategory($data,$parent_id,$cate_check){
                                            foreach ($data as $val) {
                                                if ($val->parent_id == $parent_id) {
                                                    //var_dump(in_array($val->id , $cate_check) + 1);
                                                    if (in_array($val->id , $cate_check) == 2){
                                                        echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' checked id='category_id' name='' value='".$val->id."'
                                                        >".$val->name."</span>";
                                                        echo "<ul class='nested'>";
                                                        buildCategory($data,$val->id,$cate_check);
                                                        echo "</li></ul>";
                                                    }else{
                                                         echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' id='category_id' name='' value='".$val->id."'
                                                           
                                                        >".$val->name."</span>";
                                                        echo "<ul class='nested'>";
                                                        buildCategory($data,$val->id,$cate_check);
                                                        echo "</li></ul>";
                                                    }
                                                }
                                            }
                                        } 
                                    ?>
                                    </ul>
                                    
                                </div>
                                <div id="add-cate">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input class="form-control"  id="name-cate-input" name="name-cate-input" value="" placeholder="Vui lòng nhập..." />
                                        <span class="error-message" id="name_cateErr">{{ $errors->first('name-cate') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Chuyên mục hiện tại </label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="0">Thư mục lớn</option>
                                            <?php showCategories($category_add) ?>
                                        </select>
                                    </div>
                                    <div class="div-btn-add">
                                        <button type="button" id="btn-add-cate" class="btn btn-info">Thêm chuyên mục</button><br><br>
                                    </div>
                                </div>
                                <div style="text-align: center;margin: 5px 0">
                                    <a style="cursor: pointer;color: blue;" id="a-add-cate"><i class="fa fa-plus"></i>Thêm mới danh mục</a>
                                    
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="project-priority">Danh mục image box</label>
                            <select class="select2 form-control select2"  data-placeholder="Choose ..." id="category_id" name="category_id" >
                                <option value="0">Danh mục cha</option>
                                @foreach ($category as $key => $value)
                                    <option value="{{ $value['id'] }}"
                                    @if ($value['id'] == $galary->category_id)
                                        selected="selected"
                                    @endif
                                    >{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   <div class="col-sm-8 text-sm-center">
                    <input type="submit" id="submit-edit" class="btn btn-success"  value="Sửa Image box">
                    <button type="reset" class="btn btn-info">Nhập hết lại</button>
                   </div>
                </div>
                <form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <input type="hidden" name ="image_pro" value="{{$galary_img == null ? '' : $galary_img->id}}" id="image_pro">
        <input type="hidden" name="albumb_id" value="{{$galary->media_id}}" id="albumb_id">
        <input type="hidden" value="{{$galary->id}}" id="galary_id" name="link_id">
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

                        //refest lai trang
                        event.preventDefault();
                        event.stopPropagation();

                        if (form.checkValidity() === true) {
                              updateImage();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function updateImage(){
            var description = $('#description').val();
            var media_id = $('#image_pro').val();
            var id = $("#galary_id").val();
            var category_id = $("#category_id").val(); 
            var url = $("#url").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update.image.box') }}",
                data: {
                    title:$('#title').val(),
                    description:description,
                    media_id: media_id,
                    url:url,
                    category: category_id,
                    id: id,
                },
                success:function (data) {
                    console.log(data);
                    window.location.href ='{{route('index.image.box')}}';
                    //alert('Image box đã được sửa');
                     //window.history.back();
                },
                error: function(response) {
                    $('#titleErr').show();
                    $('#descriptionErr').text(response.responseJSON.errors.description);
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