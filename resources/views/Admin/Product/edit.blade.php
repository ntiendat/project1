@extends('layouts.master')

@section('title') Sửa sản phẩm @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
       <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.product')}}">Danh sách sản phẩm</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa sản phẩm</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
      </ol>
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Sửa
                            Sản phẩm
                        </h1>
                    </div>
                </div>

                <form  method="POST" class="outer-repeater needs-validation" novalidate >

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="form-group">
                            <label>Tiêu đề (*)</label>
                           <input class="form-control" maxlength="255" name="title" id="title"  placeholder="Vui lòng nhập..." value=" {{$product->title}}" required maxlength="255" />
                            <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề sản phẩm không được để trống </span></div>
                        </div>
                        <div class="form-group">
                            <label>Miêu tả ngắn</label>
                            <textarea name="content" class="form-control" id="short_content" rows="10" >{{$product->short_content}}</textarea>
                            <span class="error-message" id="contentErr">{{ $errors->first('short_content') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="content" class="form-control" id="content" rows="10" >{{$product->content}}</textarea>
                            <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Thông số kỹ thuật</label>
                           <textarea name="parameter" id="parameter" class="materialize-textarea">{{$product->parameter}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nguyên lý hoạt động</label>
                           <textarea name="principles" id="principles" class="materialize-textarea">{{$product->principles}}</textarea>
                            <!-- <span class="error-message" id="contentErr">{{ $errors->first('content') }}</span> -->
                        </div>
                        <div class="form-group">
                            <label>Gía thực </label>
                            <input class="form-control" type="number" name="price"  id="price" placeholder="Vui lòng nhập..." value="{{$product->price}}" />
                            <span class="error-message" id="priceErr">{{ $errors->first('price') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Gía khuyến mãi </label>
                            <input class="form-control" type="number" name="promotion_price" id="promotion_price" placeholder="Vui lòng nhập..." value="{{$product->promotion_price}}" />
                            <span class="error-message" id="promotion_priceErr">{{ $errors->first('promotion_price') }}</span>
                        </div>
                        <div class="col-sm-8 text-sm-center">
                        <input type="submit" id="submit-edit-pro" class="btn btn-success"  value="Cập Nhật">
                        </div>
                    </div>
                    
                    @include('Admin.right-col-edit-pro')


                </div>
                <!-- /.row -->
                </form>
            </div>
            <!-- /.container-fluid -->
      </div>
        <input type="hidden" name ="image_pro" value="{{$product->product_media_id}}" id="image_pro">
        <input type="hidden" value="{{$product->id}}" id="product_id" name="link_id">
       
        <input type="hidden" name="albumb_id" value="@foreach($product_media as $product_media){{$product_media->media_id}},@endforeach" id="albumb_id">
       
        {{-- <input type="hidden" name="albumb_id"  id="albumb_id"> --}}
@endsection
<!-- @section('footer-script')
 <script>
        CKEDITOR.replace( 'content' );
        $(window).on('load', function (){
            $( '#content' ).ckeditor();
        });
</script>
@endsection -->
@section('script')

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {

                //alert("true");
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        // alert('aa');
                         event.preventDefault();
                         event.stopPropagation();
                        if (form.checkValidity() === true) {
                           updateProduct();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function updateProduct(){
            var content = CKEDITOR.instances['content'].getData();
            var short_content = CKEDITOR.instances['short_content'].getData();
            var parameter = CKEDITOR.instances['parameter'].getData();
            var principles = CKEDITOR.instances['principles'].getData();
            var product_media_id = $('#image_pro').val();
            var albumb = $('#albumb_id').val();
            var lang = $('input[name=lang]:checked').val();
            // alert(albumb);
            var tag = $("#tag_id").val();
            var id = $("#product_id").val();
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
                url: "{{ route('update.product') }}",
                data: {
                    title:$('#title').val(),
                    content:content,
                    short_content:short_content,
                    parameter:parameter,
                    principles:principles,
                    price:$('#price').val(),
                    promotion_price:$('#promotion_price').val(),
                    title:$('#title').val(),
                    product_media_id: product_media_id,
                    category: list,
                    media_id: albumb,
                    id: id,
                    lang: lang,
                    tag: tag
                },
                success:function (data) {
                    console.log(data);
                    window.location.href ='{{route('index.product')}}';
                    // alert('Sửa sản phẩm thành công');
                },
                error: function (response) {
                    $('#titleErr').show();
                    $('#contentErr').text(response.responseJSON.errors.content);
                    $('#priceErr').text(response.responseJSON.errors.price);
                    $('#promotion_priceErr').text(response.responseJSON.errors.promotion_price);                   
                    $('#category_idErr').text(response.responseJSON.errors.category);
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
            var name = $('#name-cate-input').val();
            
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
                    // $('#img_productErr').text(response.responseJSON.errors.name);

                    
                }
            })
        });
        $('#selectmultiimage').on('click',function(){
            $('#myModal').modal('show');
            isMultiSelected = true;
        })
    </script>
   
@endsection

