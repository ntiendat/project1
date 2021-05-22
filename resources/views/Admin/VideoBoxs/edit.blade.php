@extends('layouts.master')

@section('title') Sửa Video box @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.video.box')}}">Danh sách Video box</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa Video box</a></li>
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
                          Video box
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation" method="POST" enctype="multipart/form-data" novalidate >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tiêu đề Video box(*)</label>
                           <input class="form-control" name="title" id="title" 
                           value="{{$galary->title}}" 
                           placeholder="Vui lòng nhập..." required />
                           <!-- <span class="error-message" id="titleErr" style="display: none"><em class="icon-error"></em> Tiêu đề Video box không được để trống</span> -->
                           <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề Video không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="description" class="form-control" id="description" rows="5" >{{$galary->description}}</textarea>
                            <span class="error-message" id="descriptionErr">{{ $errors->first('description') }}</span>
                        </div>
                       
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input class="form-control" name="url" id="url" value="{{$galary->url}}" placeholder="Vui lòng nhập..." />
                        </div>
                        <div>
                            <div class="modal fade" id="myModal">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Chọn Video box</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thư viện</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upload file</a>
                                            <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                                                class="dropzone" id="dropzone">
                                                @csrf
                                            </form>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                         <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <h3>filter media</h3>
                                            <div class="row" style="position: relative;">
                                                <div class="form">
                                                    <div class="div-select">
                                                        <select name="" id="" class="select-all">
                                                            <option value="">Chọn ảnh</option>
                                                            <option value="">Tác vụ</option>
                                                            <option value="">Tác vụ</option>
                                                            <option value="">Tác vụ</option>
                                                        </select>
                                                    </div> 
                                                    <div class="div-select" style="">
                                                        <select name="" id=""class="select-all">
                                                            <option value="">Tất cả các ngày</option>
                                                            <option value="">Tìm theo</option>
                                                            <option value="">Tìm theo</option>
                                                            <option value="">Tìm theo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" div-add" style="">
                                                      <input type="text" placeholder="Tìm kiếm...">
                                                </div>
                                            </div><br>
                                            <div class="row img-row">
                                                @foreach($media as $media)
                                                <div class="col-md-2 text-center"  >
                                                    <img id="img_{{$media->id}}" src="{{asset('Media'.$media->url)}}" width="100%" height="100px" alt="">
                                                    <input type="checkbox" name="media_id" value="{{$media->id}}">
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                                           <div class="row">
                                                <div class="col-md-10">
                                                    <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                                                        class="dropzone" id="dropzone">
                                                    @csrf
                                                    </form>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="button" id="add_image" class="btn btn-success"  value="Thêm ảnh">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" id="btn-oke" class="btn btn-secondary" data-dismiss="modal">Oke</button>
                                  </div>

                                </div>
                              </div>
                            </div>

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
                            <label for="project-priority">Danh mục Video box</label>
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
                        <input type="submit" id="submit-edit" class="btn btn-success"  value="Sửa Video box">
                        <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                </div>
                <form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <input type="hidden" name ="image_pro" value="{{$galary->media_id}}" id="image_pro">
        <input type="hidden" name="albumb_id" value="" id="albumb_id">
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
                            updateVideo();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

       function updateVideo(){
            var description = $('#description').val();
            var media_id = $('#image_pro').val();
            var id = $("#galary_id").val();
            var category_id = $("#category_id").val(); 
            var url =$("#url").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update.video.box') }}",
                data: {
                    title:$('#title').val(),
                    description:description,
                    category: category_id,
                    url:url,
                    id: id,
                },
                success:function (data) {
                    window.location.href ='{{route('index.video.box')}}';
                    // alert('Video box đã được sửa');
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