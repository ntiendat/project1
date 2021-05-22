@extends('Client.Layouts.master')

@section('title-client')
    <title> Trang chủ</title>
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
                    <ul class="menuvertical" id="dropdown">

                        <?php
                             
                        buildMenuClient4($menu,0);
                        function buildMenuClient4($data,$parent_id){
                            
                            foreach ($data as $val) {
                             
                                if($val->parent_id == $parent_id) {
                                    
                                    echo "<li>";
                                     
                                    //    if($val->type==2){
                                                echo "<a  class='d-block' href='".route('get.list.product',['id'=>$val->id])."' id='view_category_post_".$val->id."'><span>".$val->name."</span></a>";
                                            // }  
                                    
                                        if(collect($data)->contains('parent_id', $val->id)){
                                        echo "<ul  class=\"ul-chid\" >";
                                        buildMenuClient4($data,$val->id);
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
                <p>{{$product->title}}</p>
            </div>
            <div class="noi_dung">
                <div class="layer-content">
                    <div class="row row-detail">
                        <div class="col-sm-6 detail-image">
                            <img src="{{ asset('Media/' . $product->Media->url) }}"
                                alt="upload/images/SP_Treventus/ScanRobot_2_0_MDS_300dpi.png">
                        </div>
                        <div class="col-sm-6 detail-info">
                            <p class="tit-detail">Mô tả</p>
                            <div class="information-dt">
                              
                                @if (count($product->lang)!=0)
                                     @foreach (  $product->lang as $item )
                                            @if ($item->lang == config('app.locale'))
                                                  {!! $item->short_content !!}
                                
                                             @else
                                                {!! $product->short_content !!}
                                            @endif
                                      @endforeach
                                @else
                                {!! $product->short_content !!}
                                @endif
                               
                            </div>
                            <p class="support-title">Liên hệ nhanh với bộ phận tư vấn</p>
                            <div class="support-content">
                                <ul>
                                    <li>
                                        <a href="skype:live:thanhba.tnt77?chat">
                                            <img
                                                src="{{asset('asset/icon-skyper.png')}}">
                                        </a>
                                        <span class="support-name">Kinh doanh</span>
                                        <a href="tel:024 3776 0956">
                                            <img
                                                src="{{asset('asset/icon-phone-pr.png')}}">
                                            090 345 22 33</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--        end row -->
                    <div class="detail-content">
                        <div class="tabs-product">
                            <ul class="ul-product-tab">
                                <li class="item-tab active" data-id="tab1">
                                    <div class="item-tabs ">
                                        Giới thiệu khái quát sản phẩm </div>
                                </li>
                                <li class="item-tab " data-id="tab2">
                                    <div class="item-tabs">
                                        Thông số kỹ thuật </div>
                                </li>
                                <li class="item-tab " data-id="tab21">
                                    <div class="item-tabs">
                                        Nguyên lý hoạt động </div>
                                </li>
                                <li class="item-tab  last-item" data-id="settings">
                                    <div class="item-tabs">
                                        Catalog </div>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tabs-content">
                                    <div id="tab1" class="tabs-items active-tabs">
                                        @if (count($product->lang)!=0)
                                        @foreach (  $product->lang as $item )
                                               @if ($item->lang == config('app.locale'))
                                                     {!! $item->content !!}
                                   
                                                @else
                                                   {!! $product->content !!}
                                               @endif
                                         @endforeach
                                   @else
                                   {!! $product->content !!}
                                   @endif
                                       
                                    </div>
                                    <div id="tab2" class="tabs-items ">
                                        @if (count($product->lang)!=0)
                                        @foreach (  $product->lang as $item )
                                               @if ($item->lang == config('app.locale'))
                                                     {!! $item->parameter !!}
                                   
                                                @else
                                                   {!! $product->parameter !!}
                                               @endif
                                         @endforeach
                                   @else
                                   {!! $product->parameter !!}
                                   @endif
                                       
                                    </div>
                                    <div id="tab21" class="tabs-items">
                                         @if (count($product->lang)!=0)
                                        @foreach (  $product->lang as $item )
                                               @if ($item->lang == config('app.locale'))
                                                     {!! $item->principles !!}
                                   
                                                @else
                                                   {!! $product->principles !!}
                                               @endif
                                         @endforeach
                                   @else
                                   {!! $product->principles !!}
                                   @endif
                                       
                                    </div>
                                    <div id="settings" class="tabs-items tab-download">
                                        <script>
                                            $(document).ready(function () {
                                                $('.download-show span').on('click', function () {
                                                    alert('Vui lòng nhập thông tin để tải tài liệu');
                                                })
                                            });
                                        </script>
                                        <style>
                                            .download-show span {
                                                cursor: pointer;
                                            }
                                        </style>
                                        <div class="col-sm-8 col-md-6 col-reg">
                                            <p class="text-center">Vui lòng nhập thông tin để tải tài liệu.</p>
                                            <div class="reg-inner">
                                                <div id="register" class="formular validationEngineContainer"
                                                    data-base="http://namhoang.com.vn/" data-id="23">
                                                    <input value="" name="name" placeholder="Tên"
                                                        class="r-name validate[required] text-input">
                                                    <input value="" name="phone" placeholder="Điện thoại"
                                                        class="r-phone validate[required,custom[integer],minSize[10],[maxSize[15]] text-input ">
                                                    <input value="" name="email" placeholder="Email"
                                                        class="r-email validate[required,custom[email]] text-input ">
                                                    <input value="" name="address"
                                                        placeholder="Địa chỉ làm việc"
                                                        class="r-address validate[required] text-input">
                                                    <button>Gửi đi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (isset($related))
                            <div class="related-products">
                                <div class="title">
                                    <h3>SẢN PHẨM KHÁC</h3>
                                </div>
                                <div class="owl-carousel owl-theme" id="owl-related">
                                    @foreach ($related as $related)
                                        <!-- Shop Item -->
                                        <div class="item">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><a href="{{ route('home.list.product', $related->id) }}">
                                                        
                                                            @if ($related->product_media_id != null)
                                                                <img src="{{ asset('Media/' . $related->Media->url) }}" alt=""
                                                                    style="width:200px !important;height:175px !important;">
                                                            @else
                                                                <img src="Media/image_product.jpg" alt=""
                                                                    style="width:200px !important;height:175px !important;">
                                                            @endif
            
                                                        </a></figure>
                                                    @if ($related->promotion_price != 0)
                                                        <span class="onsale">Sale</span>
                                                    @endif
                                                </div>
                                                <div class="lower-content">
                                                    <h4 class="name"><a href="{{ route('home.list.product', $related->id) }}"
                                                            class="cate-mobile-list"
                                                            style="font-size: 14px !important;">{{ $related->title }}</a></h4>
                                                    <div class="price" style="font-size: 14px !important;">
                                                        @if ($related->promotion_price != 0)
                                                            {{ $related->promotion_price == null ? '' : number_format($related->promotion_price) . '₫' }}
                                                            <sup></sup>
                                                            <del>{{ $related->price == null ? '' : number_format($related->price) . '₫' }}</del>
                                                            <sup></sup>
                                                        @else
                                                            {{ $related->price == null ? '' : number_format($related->price) . '₫' }}<sup></sup>
                                                        @endif
                                                    </div>
            
            
                                                    @if ($related->price != 0 || $related->price != null)
                                                        {{ number_format($related->promotion_price) }} <sup>đ</sup>
                                                        <del>{{ number_format($related->price) }} </del> <sup>đ</sup>
                                                        <button type="button" class="btn btn-danger add-to-cart"
                                                            data-id="{{ $related->id }}" style="font-size: 14px !important;">Add to
                                                            cart</button>
                                                    @else
                                                    @endif
            
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
        $(document).ready(function() {
        $("#owl-related").owlCarousel({
        autoplay: true, //Set AutoPlay to 3 seconds
        autoplayTimeout:1000,
        // autoplayHoverPause:true,
        items: 3,
        loop: true,
        // dots: false,
    });
        });
</script>
@endsection
