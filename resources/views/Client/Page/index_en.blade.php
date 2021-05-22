@extends('Client.Layouts.master')

@section('title-client')
    <title> {{ trans('mess.Home') }}ủ</title>
@endsection

@section('content-client')
    
<div class="breadcrumb-edit">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="bread">
                    <li><a href="http://namhoang.com.vn/">{{ trans('mess.Home') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>














<div class="main main-product">
    <div class="container">
        <p class=" mx-auto d-block home-title">{{ trans('mess.product') }}</p>
        <div  class=" mx-auto d-block row">
            <div class="col-md-1"></div>
            <div class="col-md-2 col-xs-12">
                <div class="product-home-inner">
                    <div class="img-index-pro">
                        <a  href="{{route('get.list.product',25)}}">
                            <img class="elem"
                                src="{{asset('asset/1-14.png')}}"
                                alt="upload/images/chuyen-muc/1-14.png">
                        </a>
                    </div>
                    <p class="title-cate-index">
                        <a href="{{route('get.list.product',25)}}">{{ trans('mess.document') }}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="product-home-inner">
                    <div class="img-index-pro">
                        <a ef="{{route('get.list.product',26)}}">
                            <img class="elem"
                                src="{{asset('asset/1.png')}}"
                                alt="upload/images/chuyen-muc/1.png">
                        </a>
                    </div>
                    <p class="title-cate-index">
                        <a href="{{route('get.list.product',26)}}">{{ trans('mess.Powerdocument') }}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="product-home-inner">
                    <div class="img-index-pro">
                        <a href="{{route('get.list.product',1511)}}">
                            <img class="elem"
                                src="{{asset('asset/1-05.png')}}"
                                alt="upload/images/chuyen-muc/1-05.png">
                        </a>
                    </div>
                    <p class="title-cate-index">
                        <a href="{{route('get.list.product',1511)}}">{{ trans('mess.Software') }}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="product-home-inner">
                    <div class="img-index-pro">
                        <a href="{{route('get.list.product',31)}}">
                            <img class="elem"
                                src="{{asset('asset/1-07.png')}}"
                                alt="upload/images/chuyen-muc/1-07.png">
                        </a>
                    </div>
                    <p class="title-cate-index">
                        <a href="{{route('get.list.product',31)}}">{{ trans('mess.DEVICE') }}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <div class="product-home-inner">
                    <div class="img-index-pro">
                        <a href="{{route('get.list.product',43)}}">
                            <img class="elem"
                                src="{{asset('asset/1-09.png')}}"
                                alt="upload/images/chuyen-muc/1-09.png">
                        </a>
                    </div>
                    <p class="title-cate-index">
                        <a href="{{route('get.list.product',43)}}">{{ trans('mess.DIGITAL') }}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
<!-- end -->
<div class="main main-about">
    <div class="container">
        <p class="home-title">{{ trans('mess.About') }}</p>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="body-about">
                    <h1 style="text-align:justify"><span style="font-family:arial"><span
                                style="font-size:14px">{{ trans('mess.company') }}</span></span></h1>
                    <a href="{{route('home.list.post',12)}}" class="link_readmore">
                        {{ trans('mess.detail') }} &gt;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->
<div style="background: url(http://namhoang.com.vn/upload/images/tin-tuc/bg_kh.png) no-repeat;background-size: cover;"
    class="main main-kh">
    <div class="container">
        <p class="home-title">  {{ trans('mess.customers') }}</p>
        <div class="row">
            <div class="col-xs-12">
                <div class="slide_project owl-carousel owl-theme" >
                    @foreach($khtb as $kh)
                        <div class="item item-kh">
                            <div class="cell_project_index">
                                <div class="cell_project_inner">
                                    <div class="image-kh zoom_effect">
                                        <a href="{{route('home.list.post',$kh->id)}}">
                                            <img src="{{asset('Media/'.$kh->Media->url)}}"
                                                alt="ĐH Quốc gia Hà Nội">
                                        </a>
                                    </div>
                                    <p class="title_project"><a
                                            href="{{route('home.list.post',$kh->id)}}">{{$kh->title}}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach                  
                </div>
            </div>
        
        </div>
    </div>
</div>
<!-- end -->
<div class="main main-art">
    <div class="container">
        <p class="home-title">{{ trans('mess.NEWS') }}</p>
        <div class="row">
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".slide_project").owlCarousel({
            items: 4,
            pagination: true,
            navigation: true,
            navigationText: true,
            autoPlay: 5000
        });
    });
</script>
@endsection
