<!-- ========== Left Sidebar Start ========== -->
<style type="text/css">
    .icon{
        position: absolute;
        right: 10px;
            }
    .change .icon {
            -webkit-transform: rotate(-145deg) translate(-9px, 6px);
            transform: rotate(-180deg) translate(0px, 0px);
        }

</style>
<script>
        function myFunct(x) {
            x.classList.toggle("change");
        }
    </script>
<div class="vertical-menu">

    <div class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" >
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);"  >
                        <i class="fas fa-book"></i>
                        <span>Quản lý đơn hàng</span><span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('list.bill')}}">Danh sách đơn hàng</a></li>
                    </ul>
                </li>

                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);"  >
                        <i class="fas fa-book"></i>
                        <span>Quản lý sản phẩm</span><span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false"> 
                        <li><a href="{{route('index.product')}}">Danh sách sản phẩm</a></li>
                        <li><a href="{{route('create.product')}}">Thêm sản phẩm</a></li>
                        <li><a href="{{route('pendding.index.comment.product')}}">Danh sách bình luận</a></li>
                        <li><a href="{{route('index.product.category')}}">Danh mục sản phẩm</a></li>
                        <li><a href="{{route('index.tag.product')}}">Danh sách tag sản phẩm</a></li>
                    </ul>
                </li>

                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);" >
                       <i class="fa fa-list-alt"></i>
                        <span>Quản lý bài viết</span>   <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.post')}}">Danh sách bài viết</a></li>
                        <li><a href="{{route('create.post')}}">Thêm bài viết</a></li>
                        <li><a href="{{route('pendding.index.comment')}}">Danh sách bình luận</a></li>
                        <li><a href="{{route('index.post.category')}}">Danh mục bài viết</a></li>
                        <li><a href="{{route('index.tag.post')}}">Danh sách tag bài viết</a></li>
                    </ul>
                </li>
                {{-- <li onclick="myFunct(this)">
                    <a href="javascript: void(0);" >
                        <i class="fa fa-bars"></i>
                        <span>Quản lý danh mục</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    </ul>
                </li> --}}
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);" >
                       <i class="fa fa-camera"></i>
                        <span>Quản lý thư viện</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.image.media')}}">Thư viện ảnh</a></li>
                        <li><a href="{{route('index.video.media')}}">Thư viện video</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);" >
                       <i class="fa fa-list-alt"></i>
                        <span>Quản lý Form</span>   <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.form')}}">Danh sách Form</a></li>
                        <li><a href="{{route('create.form')}}">Thêm Form</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);"  >
                       <i class="fa fa-sliders-h"></i>
                        <span>Quản lý Slide</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.slide')}}">Danh sách Slide</a></li>
                        <li><a href="{{route('create.slide')}}">Thêm mới Slide</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);"  >
                       <i class="fa fa-warehouse"></i>
                        <span>Quản lý Galary</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.galary')}}">Danh sách Galary</a></li>
                        <li><a href="{{route('create.galary')}}">Thêm mới Galary</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);"  >
                       <i class="fa fa-images"></i>
                        <span>Quản lý Image Box</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.image.box')}}">Danh sách Image Box</a></li>
                        <li><a href="{{route('index.categoryimage',3)}}">Danh mục Image Box</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);"  >
                       <i class="far fa-file-video"></i>
                        <span>Quản lý Video Box</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.video.box')}}">Danh sách Video Box</a></li>
                        <li><a href="{{route('index.categoryvideo',4)}}">Danh mục Video Box</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);" >
                        <i class="fa fa-user"></i>
                        <span>Quản lý người dùng</span> <span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('index.user')}}">Thông tin người dùng</a></li>
                    </ul>
                </li>
                <li onclick="myFunct(this)">
                    <a href="{{route('index')}}"  >
                        <i class="fas fa-percent"></i>
                        <span>Quản lý voucher</span> <span class="icon"></span></span>
                    </a>
                </li>
                <li onclick="myFunct(this)">
                    <a href="{{route('list.contact')}}"  >
                        <i class="fa fa-address-card"></i>
                        <span>Danh sách liên hệ</span> <span class="icon"></span></span>
                    </a>
                </li>
                <li onclick="myFunct(this)">
                    <a href="javascript: void(0);">
                    {{-- <a href="{{route('create.menu')}}"> --}}
                        <i class="fa fa-bars"></i>
                        <span>Quản lý menu</span> <span class="icon"></span><span class="icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{route('create.menu')}}">Quản lí Master Menu</a></li> --}}
                        <li><a href="{{route('index.menu')}}">Quản lý  Menu</a></li>
                    </ul>
                </li>

                <li onclick="myFunct(this)">
                    <a href="{{route('edit.company')}}" >
                        <i class="fa fa-info"></i>
                        <span>Thông tin công ty</span> <span class="icon"></span></span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

