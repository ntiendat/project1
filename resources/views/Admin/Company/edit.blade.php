@extends('layouts.master')

@section('title') Xem thông tin công ty @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Xem thông tin công ty</a></li>
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
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Xem
                           thông tin công ty
                        </h1>
                    </div>
                    @foreach($company as $company)
                    <!-- /.col-lg-12 -->
                    {{-- <div class="col-lg-12 col-md-12" style="padding-bottom:120px"> --}}
                     <form  class="outer-repeater needs-validation"  method="POST" enctype="multipart/form-data" novalidate  >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- <div class="row">
                        <div class="col-lg-6 col-md-6"> -->
                            <div class="form-group">
                                <label>Tên công ty</label><br>
                              <input type="text" name="name" id="name" value="{{$company->name}}" class="form-control" required maxlength="255">
                               <span class="error-message" id="nameErr">{{ $errors->first('name') }}</span>
                                <div class="invalid-feedback"><em></em> <span class="title-message">Tên công ty không được để trống </span></div>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                               <input class="form-control" name="address" id="address"  placeholder="Vui lòng nhập..." value="{{$company->address}}" required="" maxlength="255" />
                               <span class="error-message" id="addressErr">{{ $errors->first('address') }}</span>
                               <div class="invalid-feedback"><em></em> <span class="title-message">Địa chỉ công ty không được để trống </span></div>
                            </div>
                            <div class="form-group">
                                <label> Hotline</label>
                                <input type="number" class="form-control" name="hotline" id="hotline" placeholder="Vui lòng nhập..." value="{{$company->hotline}}" required="" maxlength="255" />
                                <span class="error-message" id="hotlineErr">{{ $errors->first('hotline') }}</span>
                                <div class="invalid-feedback"><em></em> <span class="title-message">Số điện thoại công ty không được để trống </span></div>
                            </div>
                            <div class="form-group">
                                <label>Email </label>
                                <input class="form-control" name="email" id="email" placeholder="Vui lòng nhập..." value="{{$company->email}}" required="" maxlength="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
                                <span class="error-message" id="emailErr">{{ $errors->first('email') }}</span>
                                <div class="invalid-feedback"><em></em> <span class="title-message">Email không đúng định dạng </span></div>
                            </div>
                            <div class="form-group">
                               <label>Copyright</label><br>
                              <input type="text" name="copyright" id="copyright" class="form-control" value="{{$company->copyright}}">
                                <span class="error-message" id="copyrightErr">{{ $errors->first('copyright') }}</span>

                            </div>
                            <div class="form-group">
                                <label>Địa chỉ map</label>
                                <textarea class="form-control" name="iframe_map" id="map" rows="10" style="width: 1000px; height: 500px;">{!!$company->iframe_map!!}</textarea>
                               
                                <!-- <input  type="textarea" class="form-control" style="width: 1000px; height: 500px;" name="iframe_map" id="map" rows="10" value="{!!$company->iframe_map!!}"> -->
                                <span class="error-message" id="contentErr">{{ $errors->first('iframe_map') }}</span>
                            </div>
                            <div class="form-group">
                                <label>Ảnh Logo </label>
                                 <button type="button" id="selectLogoIcon" class="btn btn-primary select-image">
                                  Chọn ảnh
                                </button>
                                @if ($pro_media_logo == null)
                                    <div id="div_albumb" style="padding-top: 20px">
                                        <div id="img_thumb_logo" style="width:200px;height:200px;position:relative;display:none;">
                                            <img id="img_logo" name="img_logo" style="padding:5px" alt="" width="100%" height="120px">
                                            <a class="delete_logo_img">
                                                <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                            </a>
                                        </div>
                                    </div>
                                @else 
                                    <div id="div_albumb" style="padding-top: 20px">
                                        <div id="img_thumb_logo" style="width:200px;height:200px;position:relative;">
                                            <img id="img_logo" name="img_logo" src="{{ asset('Media/'.$pro_media_logo->url)}}" style="padding:5px" alt="" width="100%" height="120px">
                                            <a class="delete_logo_img">
                                                <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                 
                            <div class="form-group">
                                <label>Ảnh Favicon</label>
                                <button type="button" id="selectFavicon" class="btn btn-primary select-image">
                                  Chọn ảnh
                                </button>
                                @if ($pro_media_fa == null)
                                    <div id="div_albumb" style="padding-top: 20px">
                                        <div id="img_thumb_fav" style="width:200px;height:200px;position:relative;display:none;">
                                            <img id="img_fav" name="img_fav" style="padding:5px" alt="" width="100%" height="120px">
                                            <a class="delete_fav_img">
                                                <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                            </a>
                                        </div>
                                    <div>
                                @else 
                                    <div id="div_albumb" style="padding-top: 20px">
                                        <div id="img_thumb_fav" style="width:200px;height:200px;position:relative;">
                                            <img id="img_fav" name="img_fav" src="{{ asset('Media/'.$pro_media_fa->url)}}" style="padding:5px" alt="" width="100%" height="120px">
                                            <a class="delete_fav_img">
                                                <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                            </a>
                                        </div>
                                    <div>
                                @endif

                                
                                    @include('Admin.modal-image');
                                </div>
                            
                        <!-- </div> -->
                       <!--  <div class="col-lg-6 col-md-6"> -->
                            <div class="form-group">
                                <label>facebook</label>
                                <input class="form-control" name="facebook" id="facebook" placeholder="Vui lòng nhập..." value="{{$company->facebook}}" />
                                <span class="error-message" id="facebookErr">{{ $errors->first('facebook') }}</span>
                            </div>
                            <div class="form-group">
                                <label>twitter</label>
                                <input class="form-control" name="twitter" id="twitter" placeholder="Vui lòng nhập..." value="{{$company->twitter}}" />
                                <span class="error-message" id="twitterErr">{{ $errors->first('twitter') }}</span>
                            </div>
                            <!-- <div class="form-group">
                                <label>google </label>
                                <input class="form-control" name="google" id="google" placeholder="Vui lòng nhập..." value="{{$company->google}}" />
                                <span class="error-message" id="googleErr">{{ $errors->first('google') }}</span>
                            </div> -->
                            <div class="form-group">
                                <label>youtube</label>
                                <input class="form-control" name="youtube" id="youtube" placeholder="Vui lòng nhập..." value="{{$company->youtube}}" />
                                <span class="error-message" id="youtubeErr">{{ $errors->first('youtube') }}</span>
                            </div>
                            <!-- <div class="form-group">
                                <label>pinterest </label>
                                <input class="form-control" name="pinterest" id="pinterest" placeholder="Vui lòng nhập..." value="{{$company->pinterest}}" />
                                <span class="error-message" id="pinterestErr">{{ $errors->first('pinterest') }}</span>
                            </div>
                            <div class="form-group">
                                <label>instagram</label>
                                <input class="form-control" name="instagram" id="instagram" placeholder="Vui lòng nhập..." value="{{$company->instagram}}" />
                                <span class="error-message" id="instagramErr">{{ $errors->first('instagram') }}</span>
                            </div> -->
                            
                        <!-- </div> -->
                        <div class="col-sm-8 text-sm-center">
                         <input type="submit" id="submit-edit-company" class="btn btn-success"  value="Cập nhập">
                        </div>
                    </div>
                </form>
                <input type="hidden" id="id_company" value="{{$company->id}}">
                <input type="hidden" name ="hidden_image_fav" value="{{$company->favicon}}" id="hidden_image_fav">
                <input type="hidden" name ="hidden_image_logo" value="{{$company->logoicon}}" id="hidden_image_logo">
                @endforeach
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        
        
@endsection

@section('script')

    <script type="text/javascript">
        (function() {
            'use strict';
            window.addEventListener('load', function() {
               
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {

                        //refest lai trang
                        event.preventDefault();
                        event.stopPropagation();

                        if (form.checkValidity() === true) {
                            updatecompany();
                        } 

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        function updatecompany(){
            var favi_icon = $('#hidden_image_fav').val();
            var logo_icon = $('#hidden_image_logo').val();

            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update.company') }}",
                data: {
                    id:$('#id_company').val(),
                    name:$('#name').val(),
                    address:$('#address').val(),
                    favicon:favi_icon,
                    logoicon:logo_icon,
                    hotline:$('#hotline').val(),
                    email:$('#email').val(),
                    copyright:$('#copyright').val(),
                    facebook:$('#facebook').val(),
                    twitter:$('#twitter').val(),
                    youtube:$('#youtube').val(),
                    iframe_map:$('#map').val()
                },
                success:function (data) {
                    showMessage("Thông tin công ty đã được sửa",1);
                    //window.location.href="{{route('edit.company')}}";
                    // alert('Thông tin công ty đã được sửa.');
                },
                error: function (response) {
                    $('#nameErr').text(response.responseJSON.errors.name);
                    $('#addressErr').text(response.responseJSON.errors.address);
                    $('#faviconErr').text(response.responseJSON.errors.favicon);
                    $('#share_iconErr').text(response.responseJSON.errors.share_icon);
                    $('#hotlineErr').text(response.responseJSON.errors.hotline);
                    $('#emailErr').text(response.responseJSON.errors.email);
                    $('#copyrightErr').text(response.responseJSON.errors.copyright);
                    $('#facebookErr').text(response.responseJSON.errors.facebook);
                    $('#twitterErr').text(response.responseJSON.errors.twitter);
                    $('#youtubeErr').text(response.responseJSON.errors.youtube);
                    $('#contentErr').text(response.responseJSON.errors.iframe_map);
                }
            })
            return false;
        }

    </script>
@endsection