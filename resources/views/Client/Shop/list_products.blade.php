@extends('Client.Layouts.master')

@section('title-client')
    <title> {{ trans('mess.Home') }}</title>
@endsection



@section('content-client')











<div class="breadcrumb-edit">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="bread">
                    <li><a href="http://namhoang.com.vn/">{{ trans('mess.Home') }}</a></li>
                    <li><a href="http://namhoang.com.vn/san-pham">Sản phẩm</a></li>
                    <li><a href="http://namhoang.com.vn/thiet-bi-phan-mem-so-hoa-tai-lieu">Thiết bị, phần mềm số
                            hóa tài liệu</a></li>
                    <li><a href="http://namhoang.com.vn/thiet-bi-so-hoa-tu-dong">Thiết bị số hóa tự động</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container body-page-detail">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="menu_doc">
                <div class="title_menu_doc">
                    <p>Danh mục sản phẩm</p>
                </div>
                <div class="menuvertical">
                 
                    <ul class="menuvertical">

                        <?php
                            buildMenuClient3($menuu,$pid);
                            function buildMenuClient3($data,$parent_id){
                                
                                foreach ($data as $val) {
                                 
                                    if($val->parent_id == $parent_id) {
                                        
                                        echo " <li class='' >";
                                            if($val->type==4){
                                                // <a href="http://namhoang.com.vn/gioi-thieu">Giới thiệu</a>
                                                echo "<a href=\"".route('get.list.product',['id'=>$val->link_id])."\">".$val->name."</a>";
                                            }  
                                            // elseif($val->type==2){
                                            //     echo "<a  class='d-block' href='".route('home.list.product',['id'=>$val->link_id])."' id='view_category_post_".$val->link_id."'><span>".$val->name."</span></a>";
                
                                            // }  
                                            if(collect($data)->contains('parent_id', $val->id)){
                                            echo "<ul  class=\"ul-chid\" ";
                                            buildMenuClient3($data,$val->id);
                                            echo "</ul>";
                                            }
                                            echo "<span class=\"arrow-li\"></span>";

                                              
                                        echo "</li>";
                                    }
                                }
                            }
                        ?>     
                    </ul>















                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-page">
            <div class="title_product">
                <p>Thiết bị số hóa tự động</p>
            </div>
            <div class="noi_dung">
                <div class="row">
                    <div class="col-md-3">
                        <div class="cell-pro-list">
                            <div class="img-pro-list">
                                <a href="http://namhoang.com.vn/he-thong-so-hoa-tu-dong-scanrobot">
                                    <img src="{{asset('asset/ScanRobot_2_0_MDS_300dpi.png')}}"
                                        alt="Hệ thống số hóa tự động ScanRobot">
                                </a>
                            </div>
                            <p class="title-pro-list">
                                <a href="http://namhoang.com.vn/he-thong-so-hoa-tu-dong-scanrobot">
                                    Hệ thống số hóa tự động ScanRobot </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>













    {{-- <section>
        <div class="container">
            <div class="box-similar-product mt-4">

                <div class="box-bread">
                    <div class="row">
                      <div class="col-md-8">
                        <nav>
                          <ol class="breadcrumb" style="background-color: #f5f5f5">
                            <li class="breadcrumb-item">
                              <a href="">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                              <a href="">Product </a>
                            </li>
                            <li class="breadcrumb-item active">
                              <a href="">Products</a>
                            </li>
                          </ol>
                        </nav>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" id="filter">
                              <option value="1">Default order</option>
                              <option value="4">New</option>
                              <option value="5">Much interest</option>
                              <option value="2">Prices range from low to high</option>
                              <option value="3">Prices range from hight to low</option>
                            </select>
                          </div>
                      </div>
                    </div>
                </div>

                <div id="list">
                    @include('Client.Layouts.list_products' ,['data' => $data])
                </div>                      
            </div>
        </div>       
    </section> --}}
 <script>

$(document).ready(
    function(){
        $("#filter").change(
            function(){
                var filter = $( "#filter" ).val();
                let url = '{{Request::root().'/client/product/filter/'}} '+filter;
                console.log(url);
                if(filter==2){
                $.ajax({
                    //gửi dữ liệu đi
                    url :url,
                    type:'GET',
                    //nhận dữ liệu về 
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==3 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==1 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==4 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==5 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
            }            
        );                              
    });
    </script>
@endsection
