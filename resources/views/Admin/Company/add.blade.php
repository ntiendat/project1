@extends('layouts.master')

@section('title') Thêm sản phẩm @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm sản phẩm</a></li>
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
                            Sản phẩm
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form action="{{route('add.company')}}" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label>Tên công ty</label><br>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                       <input class="form-control" name="address" placeholder="Vui lòng nhập..." />
                                       <span class="error-message">{{ $errors->first('address') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Icon trình duyệt </label>
                                        <input class="form-control" type="file" name="favicon"/>
                                        <span class="error-message">{{ $errors->first('favicon') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Icon chia sẻ</label>
                                        <input class="form-control" type="file" name="share_icon"/>
                                        <span class="error-message">{{ $errors->first('share_icon') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label> Hotline</label>
                                        <input class="form-control" name="hotline" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('hotline') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input class="form-control" name="email" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('email') }}</span>
                                    </div>
                                       <label>Copyright</label><br>
                                      <input type="text" name="copyright" class="form-control" placeholder="Vui lòng nhập...">
                                    </div>
                                    <div class="form-group">
                                        <label>facebook</label>
                                       <input class="form-control" name="facebook" placeholder="Vui lòng nhập..." />
                                       <span class="error-message">{{ $errors->first('facebook') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>google </label>
                                        <input class="form-control" name="google" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('google') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>youtube</label>
                                        <input class="form-control" name="youtube" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('youtube') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>twitter</label>
                                        <input class="form-control" name="twitter" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('twitter') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>pinterest </label>
                                        <input class="form-control" name="pinterest" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('pinterest') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>instagram</label>
                                        <input class="form-control" name="instagram" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('instagram') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ map</label>
                                        <input class="form-control" name="iframe_map" placeholder="Vui lòng nhập..." />
                                        <span class="error-message">{{ $errors->first('iframe_map') }}</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
                            <button type="reset" class="btn btn-info">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection


@section('script')
        <!-- plugin js -->
        <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
        
        <!-- jquery.vectormap map -->
        <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
        
        <!-- Calendar init -->
        <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
@endsection