
<header id="page-topbar">
    <style>
        .logo-top{
            display: inline-table;
            margin-top: 5px;
            margin-left: 20px
        }
        .float-right{
            margin-top: 0px;
            /*background-color: #eff2f7;*/
        }
        .navbar-header{
            background-color: white !important;
        }
        .name{
            color:#283d92;
        }
        .avatar-md-profile {
            height: 3rem;
            width: 3rem;
        }
    </style>
    <div class="navbar-header">
        <div class="container-fluid" >
                <div class="logo-top" >
                    
                    <img src="{{URL::asset('Media/logo.png')}}" alt="" width="150px" height="70px">
                </div>
                <div class="float-right">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($profile)
                               <img src="{{URL::asset('Media/'.$profile->url)}}" alt="hinh anh" class="avatar-md-profile mx-auto rounded-circle" width="30px" height="30px">
                            @else
                                <img src="{{URL::asset('Media/user.jpg')}}" alt="hinh anh" class="avatar-md mx-auto rounded-circle">
                            @endif
                            <span class="d-none d-xl-inline-block ml-1 name">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>
                           <i class="fa fa-angle-down name"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="{{route('profile.index',Auth::user()->id)}}"><i class="fa fa-user font-size-16 align-middle mr-1"></i> Thông tin cá nhân</a>
                            <a class="dropdown-item" href="{{route('reset.password',Auth::user()->id)}}"><i class="fa fa-key"></i> Thay đổi mật khẩu</a>
                            <a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="fa fa-power-off font-size-16 align-middle mr-1 text-danger"></i> Đăng xuất</a>
                        </div>
                    </div>
                </div>
      
        </div>
    </div>
</header>