@extends('layouts.master')

@section('title') Thêm sản phẩm @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.product')}}">Danh sách sản phẩm</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm sản phẩm</a></li>
      </ol>
    </nav>
    <style>
   .error{ color:red; } 
  </style>
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                            Sản phẩm
                        </h1>
                    </div>
                </div>
                <form class="outer-repeater needs-validation"  method="POST" enctype="multipart/form-data" novalidate >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="form-group">
                            <label>Tiêu đề (*)</label>
                           <input class="form-control" name="title_en" id="title_en" value="{{old('title')}}"  placeholder="Vui lòng nhập..." required maxlength="255" />
                           <!-- <span class="error-message" id="titleErr" style="display: none"><em class="icon-error"></em> Tiêu đề sản phẩm không đúng</span> -->
                            <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề sản phẩm không được để trống </span></div>

                           <!-- <div class="invalid-feedback">Nhập tiêu đề</div> -->
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề tiếng anh  (*)</label>
                           <input class="form-control" name="title" id="title" value="{{old('title')}}"  placeholder="Vui lòng nhập..." required maxlength="255" />
                           <!-- <span class="error-message" id="titleErr" style="display: none"><em class="icon-error"></em> Tiêu đề sản phẩm không đúng</span> -->
                            <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề sản phẩm không được để trống </span></div>

                           <!-- <div class="invalid-feedback">Nhập tiêu đề</div> -->
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                           <textarea name="content" id="content" class="materialize-textarea"></textarea>
                            <!-- <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Nội dung tiếng anh</label>
                           <textarea name="content_en" id="content_en" class="materialize-textarea"></textarea>
                            <!-- <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Thông số kỹ thuật</label>
                           <textarea name="parameter" id="parameter" class="materialize-textarea"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Thông số kỹ thuật tiếng anh</label>
                           <textarea name="parameter_en" id="parameter_en" class="materialize-textarea"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nguyên lý hoạt động</label>
                           <textarea name="principles" id="principles" class="materialize-textarea"></textarea>
                            <!-- <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Nguyên lý hoạt động tiếng anh</label>
                           <textarea name="principles_en" id="principles_en" class="materialize-textarea"></textarea>
                            <!-- <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Miêu tả ngắn</label>
                            <textarea name="short_content" class="form-control" id="short_content" ></textarea>
                            <span class="error-message" id="contentErr">{{ $errors->first('short_content') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Miêu tả ngắn tiếng anh</label>
                            <textarea name="short_content_en" class="form-control" id="short_content_en" ></textarea>
                            <span class="error-message" id="contentErr">{{ $errors->first('short_content') }}</span>
                        </div>
                        <div class="form-group">    
                            <label>Gía thực </label>

                            <input type="number" class="form-control" name="price"  id="price" placeholder="Vui lòng nhập..."  pattern="[0-9.]$" />
                            <span class="error-message" id="priceErr">{{ $errors->first('price') }}</span>
                            <!-- <div class="invalid-feedback">Nhập giá thực</div> -->
                        </div>
                        <div class="form-group">
                            <label>Gía khuyến mãi </label>
                            <input class="form-control" name="promotion_price" id="promotion_price" placeholder="Vui lòng nhập..."  />
                            <span class="error-message" id="promotion_priceErr">{{ $errors->first('promotion_price') }}</span>
                            <!-- <div class="invalid-feedback">Nhập giá khuyến mãi</div> -->
                        </div>
                    </div>
                    @include('Admin.right-col')
                    <div class="col-lg-8 col-md-8 col-sm-8 text-center">
                        <button  type="submit" class="btn btn-success">Thêm sản phẩm</button>
                        <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    </div>
                </div>
                <!-- /.row -->
                <form>
            </div>
            <!-- /.container-fluid -->
        </div>
        <input type="hidden" name ="image_pro" value="" id="image_pro">
        <input type="hidden" name="albumb_id" value="" id="albumb_id">
        <input type="hidden" value="" id="link_id" name="link_id">
@endsection
@section('script-bottom')
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

                    event.preventDefault();
                    event.stopPropagation();

                    if (form.checkValidity() === true) {
                        saveproduct();
                    } 
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        })();

        function saveproduct(){
            var content = CKEDITOR.instances['content'].getData();
            var parameter = CKEDITOR.instances['parameter'].getData();
            var principles = CKEDITOR.instances['principles'].getData();
            var short_content = CKEDITOR.instances['short_content'].getData();
            var content = CKEDITOR.instances['content_en'].getData();
            var parameter = CKEDITOR.instances['parameter_en'].getData();
            var principles = CKEDITOR.instances['principles_en'].getData();
            var short_content = CKEDITOR.instances['short_content_en'].getData();
            var product_media_id = $('#image_pro').val();
            var albumb = $('#albumb_id').val();
            var lang = $('input[name=lang]:checked').val();
            var tag = $("#tag_id").val();
            var list = [];
            $('ul#myUL').find("input:checkbox:checked").each(function (){
                list.push($(this).val());
            });

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('add.product') }}",
                data: {
                    title:$('#title').val(),
                    content:content,
                    short_content:short_content,
                    parameter:parameter,
                    principles:principles,
                    price:$('#price').val(),
                    promotion_price:$('#promotion_price').val(),
                    product_media_id: product_media_id,
                    category: list,
                    media_id: albumb,
                    tag: tag,
                    lang: lang
                },
                success:function (data) {
                    window.location.href ='{{route('index.product')}}';
                    // alert('thêm sản phẩm thành công');
                },
                error: function(response) {
                    $('#titleErr').show();
                    $('#contentErr').text(response.responseJSON.errors.content);
                    $('#priceErr').text(response.responseJSON.errors.price);
                    $('#promotion_priceErr').text(response.responseJSON.errors.promotion_price);
                    $('#product_media_idErr').text(response.responseJSON.errors.product_media_id);
                    $('#category_idErr').text(response.responseJSON.errors.category);
                    $('#media_idErr').text(response.responseJSON.errors.media_id);
                    $('#tag_idErr').text(response.responseJSON.errors.tag);
                    $('#parent_idErr').text(response.responseJSON.errors.parent_id);
                    $('#mobileNumberError').text(response.responseJSON.errors.mobile_number);
                    $('#aboutError').text(response.responseJSON.errors.about);
               }
            })

            return false;
        }
    </script>
     <script>
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
                url: "{{ route('add.category.pro') }}",
                data: {
                    name: name,
                    parent_id: parent_id
                },
                success:function (data) {
                    if(parent_id ==0){
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
        $('#selectmultiimage').on('click',function(){
            $('#myModal').modal('show');
            isMultiSelected = true;
        })
    </script>



@endsection
