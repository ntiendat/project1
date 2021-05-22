@extends('Client.Layouts.master')

@section('title-client')
    <title> Trang chủ</title>
@endsection

@section('content-client')
    <section>
        <div class="container">
            {{-- @include('Client.Layouts.sidebar')
            @include('Client.Layouts.slider') --}}
            {{-- @include('Client.Layouts.feature_product') --}}
            


<div class="box-similar-product mt-4">
   

  <div class="breadcrumb-edit">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="bread">
                    <li><a href="{{route('home.index')}}">{{ trans('mess.Home') }}</a></li>
                    <li><a href="">{{ trans('mess.product') }}</a></li>
                    {{-- <li><a href="http://namhoang.com.vn/thiet-bi-phan-mem-so-hoa-tai-lieu">  <a href="#"> {{$cate->name}}</a></li> --}}
               
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
                {{-- <ul>
                    <li class=" "><a href="http://namhoang.com.vn/tai-lieu-in">Tài liệu in </a>
                        <ul class="ul-chid">
                            <li class=""><a href="http://namhoang.com.vn/sach-tap-chi-ngoai-van-3">Sách, tạp
                                    chí ngoại văn</a></li>
                            <li class=""><a href="http://namhoang.com.vn/sach-tap-chi-quoc-van">Sách, tạp
                                    chí quốc văn</a></li>
                        </ul>
                        <span class="arrow-li"></span>
                    </li>
                    <li class=" "><a href="http://namhoang.com.vn/tai-lieu-dien-tu">Tài liệu điện tử </a>
                        <ul class="ul-chid">
                            <li class=""><a href="http://namhoang.com.vn/co-so-du-lieu-dien-tu-">Cơ sở dữ
                                    liệu điện tử </a></li>
                        </ul>
                        <span class="arrow-li"></span>
                    </li>
                    <li class=" "><a href="http://namhoang.com.vn/phan-mem-3">Phần mềm </a>
                        <ul class="ul-chid">
                            <li class=""><a href="http://namhoang.com.vn/phan-mem-quan-ly-doanh-nghiep">Phần
                                    mềm quản lý doanh nghiệp</a></li>
                            <li class=""><a href="http://namhoang.com.vn/phan-mem-luu-tru">Phần mềm lưu trữ
                                </a></li>
                            <li class=""><a
                                    href="http://namhoang.com.vn/phan-mem-thu-vien-dien-tu-va-thu-vien-so">Phần
                                    mềm thư viện điện tử và thư viện số</a></li>
                        </ul>
                        <span class="arrow-li"></span>
                    </li>
                    <li class=" "><a
                            href="http://namhoang.com.vn/thiet-bi-an-ninh-tu-dong-hoa-thu-vien">Thiết bị an
                            ninh, tự động hóa thư viện </a>
                        <ul class="ul-chid">
                            <li class=""><a href="http://namhoang.com.vn/cong-nghe-em">Công nghệ EM</a></li>
                            <li class=""><a href="http://namhoang.com.vn/cong-nghe-rfid">Công nghệ RFID</a>
                            </li>
                            <li class=""><a href="http://namhoang.com.vn/cong-nghe-hybrid-em-rfid">Công nghệ
                                    HYBRID (EM/RFID)</a></li>
                        </ul>
                        <span class="arrow-li"></span>
                    </li>
                    <li class="li-active "><a
                            href="http://namhoang.com.vn/thiet-bi-phan-mem-so-hoa-tai-lieu">Thiết bị, phần
                            mềm số hóa tài liệu </a>
                        <ul class="ul-chid">
                            <li class="hover-a"><a
                                    href="http://namhoang.com.vn/thiet-bi-so-hoa-tu-dong">Thiết bị số hóa tự
                                    động</a></li>
                            <li class=""><a
                                    href="http://namhoang.com.vn/thiet-bi-so-hoa-ban-tu-dong-thu-cong">Thiết
                                    bị số hóa bán tự động, thủ công</a></li>
                            <li class=""><a href="http://namhoang.com.vn/phan-mem-xu-ly-hinh-anh">Phần mềm
                                    xử lý hình ảnh</a></li>
                            <li class=""><a
                                    href="http://namhoang.com.vn/phan-mem-nhan-dien-ky-tu-quang-hoc-ocr">Phần
                                    mềm nhận diện ký tự quang học (OCR)</a></li>
                            <li class=""><a
                                    href="http://namhoang.com.vn/phan-mem-quan-ly-quy-trinh-so-hoa">Phần mềm
                                    quản lý quy trình số hóa</a></li>
                            <li class=""><a
                                    href="http://namhoang.com.vn/phan-mem-quan-ly-tai-nguyen-so">Phần mềm
                                    quản lý tài nguyên số</a></li>
                        </ul>
                        <span class="arrow-li"></span>
                    </li>
                </ul> --}}
                <ul class="menuvertical" id="dropdown">

                    <?php
                   
          
                        buildMenuClient2($menu,0);
                        function buildMenuClient2($data,$parent_id){
                            
                            foreach ($data as $val) {
                             
                                if($val->parent_id == $parent_id) {
                                    
                                    echo "<li>";
                                     
                                    //    if($val->type==2){
                                                echo "<a  class='d-block' href='".route('get.list.product',['id'=>$val->id])."' id='view_category_post_".$val->id."'><span>".$val->name."</span></a>";
                                            // }  
                                    
                                        if(collect($data)->contains('parent_id', $val->id)){
                                        echo "<ul  class=\"ul-chid\" >";
                                        buildMenuClient2($data,$val->id);
                                        echo "</ul>";
                                        }
                                            // echo '</li>';
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
    @include('Client.Layouts.list_products' ,['data' => $data['list_product_with_category'],'cate'=>$cate])
          
        </div>
    </div>
</div>

{{-- {!!$cate->desc!!} --}}


        </div>
        
    </section>
    <script language="javascript">
 
        // Lấy danh sách menu
        var menu = document.querySelectorAll('#dropdown > li');

        // Lặp qua từng menu để gán sự kiện click
        for (var i = 0; i < menu.length; i++)
        {
            menu[i].addEventListener("mouseover", function()
            {
                // Ẩn hết menu con
                var menuList = document.querySelectorAll('#dropdown > li > ul');
                for (var j = 0; j < menuList.length; j++) {
                    menuList[j].style.display = "none";
                }

                // Hiển thị menu hiện tại
                // đối tượng this chính là thẻ li hiện tại
                // nên ta sử dụng mảng childrent để lấy danh sách thẻ con
                // mà thẻ ul nằm ở vị trí thứ 2 nên trong mảng con nó
                // sẽ có vị trí là 1 (mảng bắt đầu từ 0)
                this.children[1].style.display = "block";
            });
        }
    </script>
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
                                            success:function(nhanve){
                                                $("#list").empty();
                                                 $('#list').html(nhanve);
                                            }
                                        }
                                        );
                                        }
                                        else if(filter==3 ){
                                            $.ajax({
                                            url :url,
                                            type:'GET',
                                            success:function(nhanve){
                                                $("#list").empty();
                                                //  $("#qh").append(nhanve);
                                                 $('#list').html(nhanve);
                                            }
                                        }
                                        );
                                        }
                                        else if(filter==1 ){
                                            $.ajax({
                                            //gửi dữ liệu đi
                                            url :url,
                                            type:'GET',
                                            //nhận dữ liệu về 
                                            success:function(nhanve){
                                                $("#list").empty();
                                                 $('#list').html(nhanve);
                                            }
                                        }
                                        );
                                        }
                                        else if(filter==4 ){
                                            $.ajax({
                                            //gửi dữ liệu đi
                                            url :url,
                                            type:'GET',
                                            //nhận dữ liệu về 
                                            success:function(nhanve){
                                                $("#list").empty();
                                                 $('#list').html(nhanve);
                                            }
                                        }
                                        );
                                        }
                                        else if(filter==5 ){
                                            $.ajax({
                                            //gửi dữ liệu đi
                                            url :url,
                                            type:'GET',
                                            //nhận dữ liệu về 
                                            success:function(nhanve){
                                                $("#list").empty();
                                                 $('#list').html(nhanve);
                                            }
                                        }
                                        );
                                        }
                                    }
                                        
                                       
                                );

            
                         
                          
                               
    }
);
    </script>
@endsection
