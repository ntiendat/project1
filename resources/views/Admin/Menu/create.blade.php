@extends('layouts.master')

@section('title') Thêm Menu @endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm Menu</a></li>
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
                <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                   Menu
                </h1>
            </div>
        </div>
        <!-- /.col-lg-12 -->

      <div class="form-group">
        <label for=""></label>
        <input type="text"  class="form-control" name="menu_name" value="" id="menu_name_master" aria-describedby="helpId" placeholder="">
        <input type="text" hidden class="form-control" name="master_menu_id" value="" id="master_menu_id" aria-describedby="helpId" placeholder="">
      
      </div>
      <div class="form-group">
        <label for=""></label>
        <input type="text"
          class="form-control" name="title" value="" id="title_master" aria-describedby="helpId" placeholder="">
      </div>
        <form  method="POST" enctype="multipart/form-data" >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class=" tab-left" onclick="myFunct(this)">
                        <a href="javascript: void(0);" onclick="myFunction()" style="width:100%;margin:5px 0" class="has-arrow waves-effect">
                            <span style="font-size: 15px;margin: 15px; width:100%">Bài viết</span> <span class="icon"><i class="fa fa-angle-down"></i></span></i>
                        </a>
                        <div id="div-post"  style="display: none;">
                             <input id="search-post" type="text" placeholder="Tìm kiếm..." class="form-control" style="font-size: 13px"><br>
                            <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" style="height: 200px; width: 358px;">
                                <div style="height: 100%; overflow-y: scroll; width: 358px; text-overflow: ellipsis; " id="search_post">
                                    @foreach($all_post as $all_post)
                                    <div style="">
                                        <input type="checkbox" id="{{$all_post->id}}" value="{{$all_post->id}}" attri="1" name="post_id">
                                        <input type="hidden" value="{{$all_post->title}}" id="name_post_{{$all_post->id}}">
                                        <input type="hidden" value="{{$all_post->type}}" id="type_post_{{$all_post->id}}">
                                        {{$all_post->title}}

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="" style="display: flex;justify-content: space-around; ">
                                <div>
                                    <a  id="select_all"><input type="checkbox" id="selectAllPost" value="selectAllPost">Chọn toàn bộ</a>
                                </div>
                                <a style="font-size: 12px;color: blue;cursor: pointer; color: white" class="btn btn-primary" id="all_on_menu_post">Thêm vào menu</a>
                            </div><br>
                        </div>
                        <span class="error-message">{{ $errors->first('title') }}</span>
                    </div>
                    <div class=" tab-left" onclick="myFunct(this)">
                        <a href="javascript: void(0);" onclick="myFunction1()" style="width:100%;margin:5px 0" class="has-arrow waves-effect">
                            <span style="font-size: 15px;margin: 15px; ">Sản phẩm</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                        </a>
                        <div id="div-product"  style="display: none;">
                            <input id="search-product" type="text" placeholder="Tìm kiếm..." class="form-control" style="font-size: 13px"><br>
                            <div class="tab-pane" id="nav-profile1" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div style="height: 200px; overflow-y: scroll; width: 358px; text-overflow: ellipsis; " id="search_pro">
                                    @foreach($all_pro as $all_pro)
                                    <div >
                                        <input type="checkbox" id="{{$all_pro->id}}" value="{{$all_pro->id}}" attri="2" name="product_id" >
                                        <input type="hidden" value="{{$all_pro->title}}" id="name_product_{{$all_pro->id}}">{{$all_pro->title}}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="" style="display: flex;justify-content: space-around; ">
                                <div>
                                    <a  id="select_all"><input type="checkbox" id="selectAllProduct" value="selectAllProduct">Chọn toàn bộ</a>
                                </div>
                                <a  style="font-size: 12px;color: blue;cursor: pointer; color: white" class="btn btn-primary" id="all_on_menu_product">Thêm vào menu</a>
                            </div><br>
                        </div>
                        <span class="error-message">{{ $errors->first('title') }}</span>
                    </div>
                    <div class=" tab-left" onclick="myFunct(this)">
                        <a href="javascript: void(0);" onclick="myFunction3()" style="width:100%;margin:5px 0" class="has-arrow waves-effect">
                            <span style="font-size: 15px;margin: 15px; width:100% ; ">Chuyên mục</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                        </a>
                        <div id="div-category"  style="display: none;">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active size-a" id="nav-home-tab" data-toggle="tab" href="#nav-home2" role="tab" aria-controls="nav-home" aria-selected="true">Bài viết</a>
                                    <a class="nav-item nav-link size-a" id="nav-profile-tab" data-toggle="tab" href="#nav-profile2" role="tab" aria-controls="nav-profile" aria-selected="false">Sản phẩm</a>
                                </div>
                            </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-home2" role="tabpanel" aria-labelledby="nav-home-tab">

                         <input id="search" type="text" placeholder="Tìm kiếm..." class="form-control" style="font-size: 13px"><br>
                        <ul id="myUL"  style="overflow-y: scroll; height: 200px;" >
                            <?php
                            buildCategory_post($category_post,0);
                            function buildCategory_post($data,$parent_id){
                                foreach ($data as $val) {
                                    if ($val->parent_id == $parent_id) {
                                        echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' id='category_post_id' attri='3' name='category_id' value='".$val->id."'><label for='' id='name_cate_post'>".$val->name."</label></span>";
                                        echo "<ul class='nested'>";
                                        buildCategory_post($data,$val->id);
                                        echo "</li></ul>";
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-profile2" role="tabpanel" aria-labelledby="nav-profile-tab">

                         <input id="searchCatePro" type="text" placeholder="Tìm kiếm..." class="form-control" style="font-size: 13px"><br>
                        <ul id="myUL">
                            <?php
                            buildCategory_product($category_product,0);
                            function buildCategory_product($data,$parent_id){
                                foreach ($data as $val) {
                                    if ($val->parent_id == $parent_id) {
                                        echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' attri='4' id='category_product_id' name='category_product_id' value='".$val->id."'><label for='' id='name_cate_product'>".$val->name."</label></span>";
                                        echo "<ul class='nested'>";
                                        buildCategory_product($data,$val->id);
                                        echo "</li></ul>";
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="" style="display: flex;justify-content: space-around; ">
                    <a  style="font-size: 12px;color: blue;cursor: pointer; color: white" class="btn btn-primary" id="all_on_menu_category">Thêm vào menu</a>
                </div><br>
            </div>
        </div>
                <div class="form-group tab-left" onclick="myFunct(this)">
                    <a href="javascript: void(0);" onclick="myFunction2()" style="width:100%;margin:5px 0" class="has-arrow waves-effect">
                        <span style="font-size: 15px;margin: 15px; width:100%">Liên kết tự tạo</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <div id="div-url"  style="display: none;">
                        <p>Tên đường dẫn</p>
                        <input type="text" class="url-menu form-control" name="name-url" id="name-url" >
                        <p>Đường dẫn</p>
                        <input type="text" class="url-menu form-control" attri="5" name="url" id="url">
                        <hr>
                        <div class="" style="display: flex;justify-content: space-around; ">
                            <a  style="font-size: 12px;color: blue;cursor: pointer; color: white" class="btn btn-primary" id="all_on_menu_url">Thêm vào menu</a>
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 form-group" style="border:1px solid">
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        <ol class="dd-list" id="ol-list-menu" >

                        </ol>
                  </div>
              </div>
          </div>
          <div style="width: 100%;" class="col-sm-8 text-sm-center"><input type="button" id="submit-add-menu" class="btn btn-success" onclick="vali()" value="Cập Nhật Menu"></div>
      </div>
      <!-- /.row -->
      <form>
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  </div>
  <input type="hidden" name="product_id" value="" id="product_id">
  <input type="hidden" name="post_id" value="" id="post_id">
  <input type="hidden" name="product_cate_id" value="" id="product_cate_id">
  <input type="hidden" name="post_cate_id" value="" id="post_cate_id">
  <input type="hidden" name="url_menu" value="" id="url_menu">
  {{-- <input type="hidden" name="" value="{{$product->title}}" id="name_pro"> --}}
  @foreach($category as $item1)
    <input type="hidden" value="{{$item1->name}}" id="name_category_{{$item1->id}}">
  @endforeach
  @foreach($category_product as $item2)
     <input type="hidden" value="{{$item2->name}}" id="name_category_product_{{$item2->id}}">
  @endforeach
  <div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal_show" >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Chọn ảnh sản phẩm</h4>
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
                        @foreach($medias as $media)
                        <div class="col-md-2 text-center"  >
                            <img id="img_{{$media->id}}" src="../../../Media/{{$media->url}}" width="100%" height="100px" alt="">
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
        <button type="button" id="btn-oke-menu" class="btn btn-secondary" data-dismiss="modal">Thêm</button>
    </div>

    </div>
    </div>

</div>

<div id="loading" style="display:none">
    <img src="https://tathome.vn/uploads/images/systems/loading.gif" alt="Loading..."/>
</div>
<div id="show-hidden-post"></div>

<div id="hidden_media"></div>
@endsection

@section('script')

<script>
    {{-- //Nestable --}}
    $('.dd').nestable('serialize');
    {{-- //Nestable --}}
    function myFunction()  {
        var div_post = document.getElementById("div-post");
        var b = document.getElementById("div-product");
        var c = document.getElementById("div-url");
        var d = document.getElementById("div-category");
        var e = document.getElementById("div-type");
        var f = document.getElementById("div-icon");
        if (div_post.style.display === "none" ) {
            div_post.style.display = "block";
            b.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
        }
        else {
            div_post.style.display = "none";

        }
    }
    function myFunction1()  {
        var div_post = document.getElementById("div-post");
        var b = document.getElementById("div-product");
        var c = document.getElementById("div-url");
        var d = document.getElementById("div-category");
        var e = document.getElementById("div-type");
        var f = document.getElementById("div-icon");

        if (b.style.display === "none") {
            b.style.display = "block";
            div_post.style.display = "none";
            c.style.display = "none";
            d.style.display = "none";
        }
        else {
            b.style.display = "none";

        }

    }
    function myFunction2()  {
        var div_post = document.getElementById("div-post");
        var b = document.getElementById("div-product");
        var c = document.getElementById("div-url");
        var d = document.getElementById("div-category");
        var e = document.getElementById("div-type");
        var f = document.getElementById("div-icon");
        if (c.style.display === "none" ) {
            c.style.display = "block";
            div_post.style.display = "none";
            b.style.display = "none";
            d.style.display = "none";
        }
        else {
            c.style.display = "none";

        }

    }
    function myFunction3()  {
        var div_post = document.getElementById("div-post");
        var b = document.getElementById("div-product");
        var c = document.getElementById("div-url");
        var d = document.getElementById("div-category");
        var e = document.getElementById("div-type");
        var f = document.getElementById("div-icon");
        if (d.style.display === "none" ) {
            d.style.display = "block";
            div_post.style.display = "none";
            c.style.display = "none";
            b.style.display = "none";
        }
        else {
            d.style.display = "none";
        }
    }

</script>

<script>

    function show_edit_category(id)
    {

        if ($(".show-edit-category_"+id).is(":hidden")){
            $(".show-edit-category_"+id).show();
        }else {
           $(".show-edit-category_"+id).hide();
       }

    }

    function show_edit_product(id)
    {
        if ($(".show-edit-product_"+id).is(":hidden")){
            $(".show-edit-product_"+id).show();
        }else {
           $(".show-edit-product_"+id).hide();
        }

    }

    function show_edit_category_product(id)
    {
        if ($(".show-edit-category_product_"+id).is(":hidden")){
            $(".show-edit-category_product_"+id).show();
        }else {
           $(".show-edit-category_product_"+id).hide();
        }

    }

    function show_render(id) {
        if ($(".show-edit-"+id).is(":hidden")){
            $(".show-edit-"+id).show();
        }else {
           $(".show-edit-"+id).hide();
       }
    }

    function  show_url(id) {
        if ($(".show-edit-url_"+id).is(":hidden")){
            $(".show-edit-url_"+id).show();
        }else {
           $(".show-edit-url_"+id).hide();
       }
    }




    function render(){
         $(".dd a").on("mousedown", function(event) { // mousedown prevent nestable click
            event.preventDefault();
            return false;
        });
    }
     function render_product(){
         $(".dd a").on("mousedown", function(event) { // mousedown prevent nestable click
            event.preventDefault();
            return false;
        });
    }
    function render_category(){
         $(".dd a").on("mousedown", function(event) { // mousedown prevent nestable click
            event.preventDefault();
            return false;
        });
    }
    function render_category_product(){
         $(".dd a").on("mousedown", function(event) { // mousedown prevent nestable click
            event.preventDefault();
            return false;
        });
    }
    function render_url(){
         $(".dd a").on("mousedown", function(event) { // mousedown prevent nestable click
            event.preventDefault();
            return false;
        });
    }
    var img_pass_id = 0;

    function icon_click(id_img) {
        img_pass_id = id_img;
        $('#myModal_show').modal('show');
        isMultiSelected = false;
        $('input[name="media_id"]').each(function() {
             this.checked = false;
         });
    }
    function edit_click(id) {
      var name = $('#_name_post_'+id).val();
        $( "#name-label-post_"+id ).html( name );
    }
    function edit_click_id(id,type) {

        var name = $('#'+type+id).val();
        alert(name);

        var url = $('#_ride_url_'+id).val();
        alert(url);
        var icon = $('#icon_'+id).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('edit.menu.id') }}",
            data:{ name:name,url:url,id:id,icon:icon },
            success:function (data) {
                alert('Menu đã được sửa');
                console.log(data);
                $( "#name-label-"+data['id'] ).html( name );
            },
            error: function (response) {
                console.log(response);
            }
        })
    }
    function delete_click_id(id) {
        // var id = $('#menu_'+id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('delete.menu.id') }}",
            data:{id:id},
            success:function (data) {
                alert('Menu đã được xóa !!!');
                console.log(data);
                $('#menu_'+data['id']).remove();
                $('#menu_'+data['id']).hide();
                $('.show-edit-'+data['id']).remove();
                $('#' + data['id']).each(function() {
                    $('#' + data['id']).attr("disabled",false);
                    this.checked = false;
                });
            },
            error: function (response) {
                console.log(response);
            }
        })
    }
     function delete_click(id) {

        $('#post_'+id).remove();
        $('.show-edit-'+id).remove();
        $('#' + id).each(function() {
            $('#' + id).attr("disabled",false);
            this.checked = false;
        });
    }
    function edit_product_click(id) {
      var name = $('#_name_product_'+id).val();
      // alert(name);
        $( "#name-label-product_"+id ).html( name );
    }
    function delete_product_click(id) {
        $('#product_'+id).remove();
        $('.show-edit-product_'+id).remove();
        $('#' + id).each(function() {
            $('#' + id).attr("disabled",false);
            this.checked = false;
        });
    }
    function edit_category_click(id) {
      var name = $('#_name_category_'+id).val();
      // alert(name);
        $( "#name-label-category_"+id ).html( name );
    }
    function edit_category_product_click(id) {
      var name = $('#_name_category_product_'+id).val();
      // alert(name);
        $( "#name-label-category_product_"+id ).html( name );
    }
    function delete_category_click(id) {
        $('#category_'+id).remove();
        $('.show-edit-category_'+id).remove();
        $('#' + id).each(function() {
            $('#' + id).attr("disabled",false);
            this.checked = false;
        });
    }
    function delete_category_click(id) {
        $('#category_product_'+id).remove();
        $('.show-edit-category_product_'+id).remove();
        $('#' + id).each(function() {
            $('#' + id).attr("disabled",false);
            this.checked = false;
        });
    }
     function edit_url_click(id) {
      var name = $('#_name_url_'+id).val();
      // alert(name);
        $( "#name-label-url_"+id ).html( name );
    }
    function delete_url_click(id) {
        $('#url_'+id).remove();
        $('.show-edit-url_'+id).remove();
        $('#' + id).each(function() {
            $('#' + id).attr("disabled",false);
            this.checked = false;
        });
    }

     //kiểm tra nếu type = url thì mới được nhập đường dẫn
    $(document).ready(function(){
       buildtree();
    });

    function buildtree() {
 
       $.ajax({
          type: "POST",
          url: "{{ route('get.all.ajax') }}",
          data: {
            "_token": "{{ csrf_token() }}",
             master_menu_id: $('#master_menu_id').val(),
            },
          success:function(data) {
            console.log(data.menu);
            buildMenu('nestable>ol',data.menu,-1);
          },
         
          error: function (response) {
            console.log(response);
          }
      })
    }
    // buildMenu($menu,-1);
    function buildMenu(node,menu,$parent_id){
      $.each(menu, function (key, value) {
            console.log(value);
          if(value.parent_id == $parent_id) {
            if(value.type == 5){
              $('#' + node).append(`
                    <li class='dd-item' id='url_${ value.id }'>
                    <div class='dd-handle' id='list_name'>
                      <label for='' id='name-label-url_${ value.id }'>${ value.name }</label>
                      <a style='float:right;position:relative' at='${ value.id }' onclick='show_url(${ value.id })'><i class='fa fa-plus-square'></i></a>
                    </div>
                    <div class='form-group show-edit-url_${ value.id }' style='border: 1px solid;background-color: azure;display:none'>
                        <div class='row' style='display: flex;justify-content: space-around;'>
                            <div class='col-md-3'style='margin-top: 10px'>
                                <label style='padding:10px'>Sửa tên</label><br>
                                <label style='padding:10px'>Sửa URL</label><br>
                            </div><div class='col-md-9' style='margin-top: 10px'>
                                <input style='padding:10px;width: 95%' class='form-control' name='name_url' id='url${ value.id }' value='${ value.name }' placeholder='Vui lòng nhập...' /><br>
                                <input style='padding:10px;width: 95%' class='form-control' name='ride_url' id='_ride_url_${ value.id }' value='${ value.url }' placeholder='Vui lòng nhập...' /><br>
                            </div>
                        </div>
                      <div class='row'>
                        <div class='col-md-3'>
                          <a id='icon_menu_${ value.id }' onclick='icon_click(${ value.id})' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a>
                        </div>
                        <div class='col-md-9'>
                          <img id='url_img_${ value.id }' attr_img='${ value.id }' src='../../../Media/${ value.icon_path }'   width='50px' height='50px'>
                        </div>
                      </div>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-${ value.id }' onclick="edit_click_id(${ value.id },'url')">Sửa</a>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-${ value.id }' onclick='delete_click_id( ${ value.id })'>Xóa</a>
                    </div>
                    <div id="show-hidden-url_${ value.id }">
                        <input type='hidden' value='${ value.type }' id='type'>
                        <input type='hidden' value='${ value.id }' id='link_id'>
                        <input type='hidden' value='${ value.icon }' id='icon_${ value.id }'>
                    </div>
                    <ol id='ol_${ value.id }' class='dd-list'>
                    </ol>
                  `)
                  buildMenu('ol_'+value.id ,menu,value.id);
                  render_url();
            }
            else if(value.type == 4){
              $('#' + node).append(`
                    <li class='dd-item' id='category_product_${ value.id }'>
                    <div class='dd-handle' id='list_name'>
                      <label for='' id='name-label-category_product_${ value.id }'>${ value.name }</label>
                      <a style='float:right;position:relative' at='${ value.id }' onclick='show_edit_category_product(${ value.id })'><i class='fa fa-plus-square'></i></a>
                    </div>
                    <div class='form-group show-edit-category_product_${ value.id }' style='border: 1px solid;background-color: azure;display:none'>
                        <div class='row' style='display: flex;justify-content: space-around;'>
                            <div class='col-md-3'style='margin-top: 10px'>
                                <label style='padding:10px'>Sửa tên</label><br>

                            </div><div class='col-md-9' style='margin-top: 10px'>
                                <input style='padding:10px;width: 95%' class='form-control' name='name_category' id='category_product${ value.id }' value='${ value.name }' placeholder='Vui lòng nhập...' /><br>
                            </div>
                        </div>
                      <div class='row'>
                        <div class='col-md-3'>
                          <a id='icon_menu_${ value.id }' onclick='icon_click(${ value.id})' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a>
                        </div>
                        <div class='col-md-9'>
                          <img id='category_product_img_${ value.id }' attr_img='${ value.id }' src='../../../Media/${ value.icon_path }'   width='50px' height='50px'>
                        </div>
                      </div>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-${ value.id }' onclick="edit_click_id(${ value.id },'category_product')">Sửa</a>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-${ value.id }' onclick='delete_click_id(${ value.id })'>Xóa</a>
                    </div>
                    <div id="show-hidden-category_product_${ value.id }">
                        <input type='hidden' value='${ value.type }' id='type'>
                        <input type='hidden' value='${ value.id }' id='link_id'>
                        <input type='hidden' value='${ value.icon }' id='icon_${ value.id }'>
                    </div>
                    <ol id='ol_${ value.id }' class='dd-list'>
                    </ol>
                  `)
                  buildMenu('ol_'+value.id ,menu,value.id);
                  render_category_product();
            }else if(value.type == 3){
              $('#' + node).append(`
                    <li class='dd-item' id='category_${ value.id }'>
                    <div class='dd-handle' id='list_category_name'>
                      <label for='' id='name-label-category_${ value.id }'>${ value.name }</label>
                      <a style='float:right;position:relative' at='${ value.id }' onclick='show_edit_category(${value.id})'><i class='fa fa-plus-square'></i></a>
                    </div>
                    <div class='form-group show-edit-category_${ value.id }' style='border: 1px solid;background-color: azure;display:none'>
                        <div class='row' style='display: flex;justify-content: space-around;'>
                            <div class='col-md-3'style='margin-top: 10px'>
                                <label style='padding:10px'>Sửa tên</label><br>
                            </div><div class='col-md-9' style='margin-top: 10px'>
                                <input style='padding:10px;width: 95%' class='form-control' name='name_category' id='category${ value.id }' value='${ value.name }' placeholder='Vui lòng nhập...' /><br>
                            </div>
                        </div>
                      <div class='row'>
                        <div class='col-md-3'>
                          <a id='icon_menu_${ value.id }' onclick='icon_click(${ value.id})' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a>
                        </div>
                        <div class='col-md-9'>
                          <img id='category_img_${ value.id }' attr_img='${ value.id }' src='../../../Media/${ value.icon_path }'   width='50px' height='50px'>
                        </div>
                      </div>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-${ value.id }' onclick="edit_click_id(${ value.id },'category')">Sửa</a>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-${ value.id }' onclick='delete_click_id( ${ value.id })'>Xóa</a>
                    </div>
                    <div id="show-hidden-category_${ value.id }">
                        <input type='hidden' value='${ value.type }' id='type'>
                        <input type='hidden' value='${ value.id }' id='link_id'>
                        <input type='hidden' value='${ value.icon }' id='icon_${ value.id }'>
                    </div>
                    <ol id='ol_${ value.id }' class='dd-list'>
                    </ol>
                  `)
                  buildMenu('ol_'+value.id ,menu,value.id);
                  render_category();
            }else if(value.type == 2){
              $('#' + node).append(`
                    <li class='dd-item' id='product_${ value.id }'>
                    <div class='dd-handle' id='list_product_name'>
                      <label for='' id='name-label-product_${ value.id }'>${ value.name }</label>
                      <a style='float:right;position:relative' at='${ value.id }' onclick='show_edit_product(${value.id})'><i class='fa fa-plus-square'></i></a>
                    </div>
                    <div class='form-group show-edit-product_${ value.id }' style='border: 1px solid;background-color: azure;display:none'>
                        <div class='row' style='display: flex;justify-content: space-around;'>
                            <div class='col-md-3'style='margin-top: 10px'>
                                <label style='padding:10px'>Sửa tên</label><br>
                            </div><div class='col-md-9' style='margin-top: 10px'>
                                <input style='padding:10px;width: 95%' class='form-control' name='name_product' id='product${ value.id }' value='${ value.name }' placeholder='Vui lòng nhập...' /><br>
                            </div>
                        </div>
                      <div class='row'>
                        <div class='col-md-3'>
                          <a id='icon_menu_${ value.id }' onclick='icon_click(${ value.id})' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a>
                        </div>
                        <div class='col-md-9'>
                          <img id='product_img_${ value.id }' attr_img='${ value.id }' src='../../../Media/${ value.icon_path }'   width='50px' height='50px'>
                        </div>
                      </div>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-${ value.id }' onclick="edit_click_id(${ value.id },'product')">Sửa</a>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-${ value.id }' onclick='delete_click_id( ${ value.id })'>Xóa</a>
                    </div>
                    <div id="show-hidden-product_${ value.id }">
                        <input type='hidden' value='${ value.type }' id='type'>
                        <input type='hidden' value='${ value.id }' id='link_id'>
                        <input type='hidden' value='${ value.icon }' id='icon_${ value.id }'>
                    </div>
                    <ol id='ol_${ value.id }' class='dd-list'>
                    </ol>
                  `)
                  buildMenu('ol_'+value.id ,menu,value.id);
                  render_product();
            }
            else{
                $('#' + node).append(`
                    <li class='dd-item' id='post_${ value.id }'>
                    <div class='dd-handle' id='list_post_name'>
                      <label for='' id='name-label-post_${ value.id }'>${ value.name }</label>
                      <a style='float:right;position:relative' at='${ value.id }' onclick='show_render(${ value.id })'><i class='fa fa-plus-square'></i></a>
                    </div>
                    <div class='form-group show-edit-${ value.id }' style='border: 1px solid;background-color: azure;display:none'>
                      <div class='row' style='display: flex;justify-content: space-around;'>
                        <div class='col-md-3'style='margin-top:10px'>
                          <label style='padding:10px'>Sửa tên</label>
                        </div>
                        <div class='col-md-9'style='margin-top:10px'>
                          <input style='padding:10px;width: 95%' class='form-control' name='name_post' id='post${ value.id }' value='${ value.name}' placeholder='Vui lòng nhập...' />
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col-md-3'>
                          <a id='icon_menu_${ value.id }' onclick='icon_click(${ value.id})' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a>
                        </div>
                        <div class='col-md-9'>
                          <img id='post_img_${ value.id }' attr_img='${ value.id }' src='../../../Media/${ value.icon_path }'  width='50px' height='50px'>
                        </div>
                      </div>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-${ value.id }' onclick="edit_click_id(${ value.id },'post')">Sửa</a>
                      <a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-${ value.id }' onclick='delete_click_id( ${ value.id })'>Xóa</a>
                    </div>
                    <div id="show-hidden-post_${ value.id }">
                        <input type='hidden' value='${ value.type }' id='type'>
                        <input type='hidden' value='${ value.type_id }' id='type_id'>
                        <input type='hidden' value='${ value.id }' id='link_id'>
                        <input type='hidden' value='${ value.icon }' id='icon_${ value.id }'>
                    </div>
                    <ol id='ol_${ value.id }' class='dd-list'>
                    </ol>
                  `)
                  buildMenu('ol_'+value.id ,menu,value.id);
                  render();
              }

          }
      });
    }

    //chọn post
    $('#all_on_menu_post').on('click',function(){
        var $boxes = $('input[name=post_id]:checked');
        // $id = $(this).val();
        // alert($id);
        var post = [];
        $boxes.each(function(){
            check_post = $(this).val();
            $id = $(this).val();
            name = $('#name_post_' +  $(this).val()).val();
            type = $('#type_post_' +  $(this).val()).val();
            // alert(type);
            var list_menu = "<li class='dd-item' id='post_"+check_post+"'><div class='dd-handle' id='list_post_name'><label for='' id='name-label-post_"+$id+"'>"+name+"</label><a style='float:right;position:relative' onclick='show_render("+$id+")' at=" + $id +"><i class='fa fa-plus-square'></i></a></div><div id='show-hidden-post_"+$id+"'></div></li>";
            $('#ol-list-menu').append(list_menu);
            post.push(check_post);

            //Xóa các loại chọn khi đã cho vào menu
            $('input[name="post_id"]').each(function() {
                if (this.checked) {
                    $("input[name=post_id]:checked").attr("disabled",true);
                    this.checked = false;
                }
            });
            var show = "<div class='form-group show-edit-"+$id+"' style='border: 1px solid;background-color: azure;display:none'><div class='row' style='display: flex;justify-content: space-around;'><div class='col-md-3'style='margin-top:10px'> <label style='padding:10px'>Sửa tên</label></div><div class='col-md-9'style='margin-top:10px'><input style='padding:10px;width: 95%' class='form-control' name='name_post' id='_name_post_"+$id+"' value='"+name+"' placeholder='Vui lòng nhập...' /></div></div><div class='row'><div class='col-md-3'><a id='icon_menu_"+$id+"' onclick='icon_click("+$id+")' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a></div><div class='col-md-9'><img id='post_img_"+$id+"' attr_img='"+$id+"' width='50px' height='50px'></div></div><a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-"+$id+"' onclick='edit_click("+$id+")'>Sửa</a><a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-"+$id+"' onclick='delete_click("+$id+")'>Xóa</a></div><input type='hidden' value='1' id='type'><input type='hidden' value='"+$id+"' id='link_id'><input type='hidden' value='"+type+"' id='type_id'><input type='hidden' value='' id='icon_"+$id+"'>";
            $('#show-hidden-post_'+$id).append(show);
         });
        $('#post_id').val(post);
        render();
    })
    // function vali(){
       
    // }
    //chọn sản phẩm
    $('#all_on_menu_product').on('click',function(){
        var $boxes = $('input[name=product_id]:checked');
        var products = [];
        $boxes.each(function(){
            check_pro = $(this).val();
            $id = $(this).val();
            name = $('#name_product_' +  $(this).val()).val();
            var list_menu = "<li class='dd-item' id='product_"+check_pro+"'><div class='dd-handle' id='list_product_name'><label for='' id='name-label-product_"+$id+"'>"+name+"</label><a style='float:right;position:relative' onclick='show_edit_product("+$id+")' at=" + $id +"><i class='fa fa-plus-square'></i></a></div><div id='show-hidden-product_"+$id+"'></div></li>";
            $('#ol-list-menu').append(list_menu);
            products.push(check_pro);
            //Xóa các loại chọn khi đã cho vào menu
            $('input[name="product_id"]').each(function() {
                if (this.checked) {
                    $("input[name=product_id]:checked").attr("disabled",true);
                    this.checked = false;
                }
            });
             var show = "<div class='form-group show-edit-product_"+$id+"' style='border: 1px solid;background-color: azure;display:none'><div class='row' style='display: flex;justify-content: space-around;'><div class='col-md-3'style='margin-top:10px'> <label style='padding:10px'>Sửa tên</label></div><div class='col-md-9'style='margin-top:10px'><input style='padding:10px;width: 95%' class='form-control' name='name_product' id='_name_product_"+$id+"' value='"+name+"' placeholder='Vui lòng nhập...' /></div></div><div class='row'><div class='col-md-3'><a id='icon_menu_"+$id+"' onclick='icon_click("+$id+")' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a></div><div class='col-md-9'><img id='product_img_"+$id+"' attr_img='"+$id+"' width='50px' height='50px'></div></div><a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-"+$id+"' onclick='edit_product_click("+$id+")'>Sửa</a><a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-"+$id+"' onclick='delete_product_click("+$id+")'>Xóa</a></div><input type='hidden' value='2' id='type'><input type='hidden' value='"+$id+"' id='link_id'><input type='hidden' value='' id='icon_"+$id+"'>";
            $('#show-hidden-product_'+$id).append(show);
        });
        $('#product_id').val(products);
        render_product();
    })

    //chọn category_post
    $('#all_on_menu_category').on('click',function(){
        var $boxes = $('input[name=category_id]:checked');
        var category_post = [];
        $boxes.each(function(){
            check_category = $(this).val();
            $id = $(this).val();
            name = $('#name_category_' +  $(this).val()).val();
            var list_menu = "<li class='dd-item' id='category_"+check_category+"'><div class='dd-handle' id='list_category_name'><label for='' id='name-label-category_"+$id+"'>"+name+"</label><a style='float:right;position:relative' onclick='show_edit_category("+$id+")'  at=" + $id +"><i class='fa fa-plus-square'></i></a></div><div id='show-hidden-category_"+$id+"'></div></li>";
            $('#ol-list-menu').append(list_menu);
            category_post.push(check_category);
            //Xóa các loại chọn khi đã cho vào menu
            $('input[name="category_id"]').each(function() {
                if (this.checked) {
                    $("input[name=category_id]:checked").attr("disabled",true);
                    this.checked = false;
                }
            });
             var show = "<div class='form-group show-edit-category_"+$id+"' style='border: 1px solid;background-color: azure;display:none'><div class='row' style='display: flex;justify-content: space-around;'><div class='col-md-3'style='margin-top:10px'> <label style='padding:10px'>Sửa tên</label></div><div class='col-md-9'style='margin-top:10px'><input style='padding:10px;width: 95%' class='form-control' name='name_category' id='_name_category_"+$id+"' value='"+name+"' placeholder='Vui lòng nhập...' /></div></div><div class='row'><div class='col-md-3'><a id='icon_menu_"+$id+"' onclick='icon_click("+$id+")' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a></div><div class='col-md-9'><img id='category_img_"+$id+"' attr_img='"+$id+"' width='50px' height='50px'></div></div><a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-"+$id+"' onclick='edit_category_click("+$id+")'>Sửa</a><a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-"+$id+"' onclick='delete_category_click("+$id+")'>Xóa</a></div><input type='hidden' value='3' id='type'><input type='hidden' value='"+$id+"' id='link_id'><input type='hidden' value='' id='icon_"+$id+"'>";
            $('#show-hidden-category_'+$id).append(show);
         });
        $('#post_cate_id').val(category_post);
        render_category();
    })
    //chọn category_product
    $('#all_on_menu_category').on('click',function(){
        var $boxes = $('input[name=category_product_id]:checked');
        var category_product = [];
        $boxes.each(function(){
            check_category = $(this).val();
            $id = $(this).val();
            name = $('#name_category_product_' +  $(this).val()).val();
            var list_menu = "<li class='dd-item' id='category_product_"+check_category+"'><div class='dd-handle' id='list_category_name'><label for='' id='name-label-category_product_"+$id+"'>"+name+"</label><a style='float:right;position:relative' onclick='show_edit_category_product("+$id+")' at=" + $id +"><i class='fa fa-plus-square'></i></a></div><div id='show-hidden-category_product_"+$id+"'></div></li>";
            $('#ol-list-menu').append(list_menu);
            category_product.push(check_category);
            //Xóa các loại chọn khi đã cho vào menu
            $('input[name="category_product_id"]').each(function() {
                if (this.checked) {
                    $("input[name=category_product_id]:checked").attr("disabled",true);
                    this.checked = false;
                }
            });
             var show = "<div class='form-group show-edit-category_product_"+$id+"' style='border: 1px solid;background-color: azure;display:none'><div class='row' style='display: flex;justify-content: space-around;'><div class='col-md-3'style='margin-top:10px'> <label style='padding:10px'>Sửa tên</label></div><div class='col-md-9'style='margin-top:10px'><input style='padding:10px;width: 95%' class='form-control' name='name_category' id='_name_category_product_"+$id+"' value='"+name+"' placeholder='Vui lòng nhập...' /></div></div><div class='row'><div class='col-md-3'><a id='icon_menu_"+$id+"' onclick='icon_click("+$id+")' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a></div><div class='col-md-9'><img id='category_product_img_"+$id+"' attr_img='"+$id+"' width='50px' height='50px'></div></div><a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-"+$id+"' onclick='edit_category_product_click("+$id+")'>Sửa</a><a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-"+$id+"' onclick='delete_category_product_click("+$id+")'>Xóa</a></div><input type='hidden' value='4' id='type'><input type='hidden' value='"+$id+"' id='link_id'><input type='hidden' value='' id='icon_"+$id+"'>";
            $('#show-hidden-category_product_'+$id).append(show);
         });
        $('#product_cate_id').val(category_product);
        render_category_product();
    })
    //chọn url
      var id_url = 0;
     $('#all_on_menu_url').on('click',function(){
         id_url += 1;
         // alert(id_url);
        var name = $('#name-url').val();
        var url = $('#url').val();
        var url_menu = [];
        var list_menu_url = " <li class='dd-item' id='url_"+id_url+"'><div class='dd-handle'><a href='"+url+"'><label for='' id='name-label-url_"+id_url+"'>"+name+"</label></a><a style='float:right;position:relative' onclick='show_url("+id_url+")' at=" + id_url +"><i class='fa fa-plus-square'></i></a></div><div id='show-hidden-url_"+id_url+"'></div></li>";
        $('#ol-list-menu').append(list_menu_url);

        var show = "<div class='form-group show-edit-url_"+id_url+"' style='border: 1px solid;background-color: azure;display:none'><div class='row' style='display: flex;justify-content: space-around;'><div class='col-md-3'style='margin-top: 10px'><label style='padding:10px'>Sửa tên</label><br><label style='padding:10px'>Sửa URL</label><br></div><div class='col-md-9' style='margin-top: 10px'><input style='padding:10px;width: 95%' class='form-control' name='name_url' id='_name_url_"+id_url+"' value='"+name+"' placeholder='Vui lòng nhập...' /><br><input style='padding:10px;width: 95%' class='form-control' name='ride_url' id='_ride_url_"+id_url+"' value='"+url+"' placeholder='Vui lòng nhập...' /><br></div></div><div class='row'><div class='col-md-3'><a id='icon_menu_"+id_url+"' onclick='icon_click("+id_url+")' style='cursor: pointer; color: blue;line-height: 69px;padding-left: 10px;'>Chọn icon</a></div><div class='col-md-9'><img id='url_img_"+id_url+"' attr_img='"+id_url+"' width='50px' height='50px'></div></div><a style='color: white;margin:0  0 10px 10px' class='btn btn-info' id='btn-edit-show-"+id_url+"' onclick='edit_url_click("+id_url+")'>Sửa</a><a style='color: white;margin:0  0 10px 10px' class='btn btn-warning' id='btn-delete-show-"+id_url+"' onclick='delete_url_click("+id_url+")'>Xóa</a></div><input type='hidden' value='5' id='type'><input type='hidden' value='"+id_url+"' id='link_id'><input type='hidden' value='"+url+"' id='url'><input type='hidden' value='' id='icon_"+id_url+"'>";
            $('#show-hidden-url_'+id_url).append(show);
        // url_menu.push(check_category);
        $('#url_menu').val(url_menu);
        render_url();
    })

    //chọn hay bỏ chọn tất cả
    $('#selectAllProduct').click(function() {
        if (this.checked) {
            $('input[name="product_id"]').each(function() {
                 this.checked = true;
            });
        } else {
            $('input[name="product_id"]').each(function() {
                this.checked = false;
            });
        }
    });
    $('#selectAllPost').click(function() {
         if (this.checked) {
             $('input[name="post_id"]').each(function() {
                 this.checked = true;
             });
         } else {
          $('input[name="post_id"]').each(function() {
             this.checked = false;
         });
      }
    });


    function saveMenu(parent_ol,parent_id) {
        var count = parent_ol.length;
        var i = 0;
        while (i < count) {
            var item = parent_ol[i];
            var id = item.id.match(/\d+/);
            var type = $('#show-hidden-'+ item.id + " #type").val();
            var link_id = $('#show-hidden-'+ item.id + " #link_id").val();
            var url = $('#show-hidden-'+ item.id + " #url").val();
            var type_id = $('#show-hidden-'+ item.id + " #type_id").val();
            var icon = $('#icon_'+id).val();
            var name = $("#name-label-" + item.id).text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('add.menu') }}",
                data: {
                    name: name,
                    type: type,
                    type_id: type_id,
                    link_id: link_id,
                    url: url,
                    icon: icon,
                    item: item.id,
                    parent_id:parent_id,
                    master_menu_id: $('#master_menu_id').val(),
                },
                success:function (data) {
                    console.log(data);
                    saveMenu($('#' + data.item + '>ol').children("li"),data.id);

                },
                error: function (response) {
                    console.log(response);
                     $('#nameErr').text(response.responseJSON.errors.name);
                }
            })
            i = i + 1;
        }
    }

    $('#submit-add-menu').on('click',function(){
        // vali();
        var name  = document.getElementById("menu_name_master").value;
        var title  = document.getElementById("title_master").value;
        if (name                 == null || 
        title                       == null ||
            name                 == "" ||
            title                       == "" )
        {
            event.preventDefault();
            alert("Chưa nhập đủ thông tin");
            return false;
        }
        $.ajax({
          type: "POST",
          url: "{{ route('create.mastermenu') }}",
          data: {
            "_token": "{{ csrf_token() }}",
            //  master_menu_id: $('#master_menu_id').val(),
             menu_name_master: $('#menu_name_master').val(),
             title_master: $('#title_master').val(),
            },
          success:function(data) {
            console.log(data);
            $("#master_menu_id").val(data);
          },
         
          error: function (response) {
            console.log(response);
          }
      })

        $.ajax({
            type: "GET",
            url: "{{ route('delete.all.menu') }}",
            success:function (data) {
                console.log(data);
                saveMenu($('#nestable>ol').children("li"),-1);
                notify("<div style='font-size:15px'><i class='fa fa-check'></i>Menu đã được cập nhật </div>",'success');
            },
            error: function (response) {
                console.log(response);
            }
        })

       


    });

    //btn oke
    $('#btn-oke-menu').on('click',function(){
        var $boxess = $('input[name=media_id]:checked');
        var id_img;
        $boxess.each(function(){
            img_id = $(this).val();
            $('#post_img_'+img_pass_id).attr('src',$('#img_' + img_id).attr("src"));
            $('#product_img_'+img_pass_id).attr('src',$('#img_' + img_id).attr("src"));
            $('#category_img_'+img_pass_id).attr('src',$('#img_' + img_id).attr("src"));
            $('#category_product_img_'+img_pass_id).attr('src',$('#img_' + img_id).attr("src"));
            $('#url_img_'+img_pass_id).attr('src',$('#img_' + img_id).attr("src"));
        });
        $('#hidden_media_' + img_id).val($boxess.val());
        $('#icon_' + img_pass_id).val(img_id);
        var media = "<input type='hidden' id='hidden_media_"+img_id+"' attr_img='"+img_id+"'  value=''>";
        $('#hidden_media').append(media);
    });

</script>
<script type="text/javascript">

    $('#search-product').on('keyup',function(){
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route('search.menu') }}',
            data: {
                'search': $value
            },
            success:function(data){
                $('#search_pro').html(data);
            }
        });
    })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>

<script type="text/javascript">
    $('#search-post').on('keyup',function(){
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route('search.menu.post') }}',
            data: {
                'search': $value
            },
            success:function(data){
                $('#search_post').html(data);
            }
        });
    })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
    $('#searchCatePro').on('keyup',function(){
        $value = $(this).val();
        // alert($value);
        $.ajax({
            type: 'get',
            url: '{{ route('search.menu.category.pro') }}',
            data: {
                'search': $value
            },
            success:function(data){
                $('#myUL').html(data);
            }
        });
    })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
