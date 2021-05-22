@extends('layouts.master')

@section('title') Profile @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Thông tin cá nhân</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
     <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"style=" margin: 0px 0 20px;">Cập Nhật Thông tin cá nhân 
                </h1>
            </div>
        </div>
        <form class="outer-repeater needs-validation"  method="POST" enctype="multipart/form-data" novalidate >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row" class="col-sm-8 text-sm-center"> 
                <div class="form-group col-md-9"> 
                    <label>Họ</label>
                    <input class="form-control" name="firstname" id="firstname" value="{{$profile->firstname}}" placeholder="Vui lòng nhập..." required maxlength="255" />
                    <!-- <span class="error-message"  id="firstnameErr">{{ $errors->first('firstname') }}</span> -->
                    <div class="invalid-feedback"><em></em> <span class="title-message">Họ không được để trống </span></div>
                </div>
                <div class="form-group col-md-9"> 
                    <label>Tên</label>
                    <input class="form-control" name="lastname" id="lastname" value="{{$profile->lastname}}" placeholder="Vui lòng nhập..." required maxlength="255" />
                    <!-- <span class="error-message" id="lastnameErr">{{ $errors->first('lastname') }}</span> -->
                     <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề sản phẩm không được để trống </span></div>
                </div>

                <div class="form-group col-md-9"> 
                    <label>tài khoản</label>
                    <input class="form-control" name="email" id="email" value="{{$profile->email}}" readonly placeholder="Vui lòng nhập..." />
                    <!-- <span class="error-message" id="emailErr">{{ $errors->first('title') }}</span> -->
                </div>
                <div class="form-group col-md-9">
                    <div class="row">
                        <div class="col-md-2"><label>Ảnh đại diện</label></div>
                        <div class="col-md-6"> 
                            <div style="width: 100%;" class="text-sm-left d-none d-sm-block">
                                <button type="button" id="selectoneimage" class="btn btn-primary">
                                    Đổi ảnh đại diện
                                </button>
                               
                            </div>
                            <br>
                            <div id="media_img_profile" name="media_img_profile" class="text-sm-left">
                                 @if ($profile->avatar == null)
                                        <div id="img_thumb" style="width:200px;height:200px;position:relative;display:none;">
                                            <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                                            <a class="delete_image_box">
                                                <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                            </a>
                                        </div>
                                    @else 
                                        <div id="img_thumb" style="width:200px;height:200px;position:relative;display:inline-block;">
                                            <img id="img_product" name="img_product" src="{{asset('Media/'.$profile->url)}}" style="margin-right:5px" alt="" width="100%" height="120px">
                                            <a class="delete_image_box"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;cursor: pointer;' ></i>
                                            </a>
                                            
                                        </div>
                                    @endif

                                   
                            </div>
                            
                             @include('Admin.modal-image');
                        </div>
                    </div>
                    <span class="error-message" id="avatarErrr">{{ $errors->first('avatar') }}</span>
                </div>
                <div  class="col-sm-8 text-sm-center"> <input type="submit" class="btn btn-success" value="Cập nhật thông tin"></div>
            </div>
        </form>
    </div>
    <input type="hidden" name ="image_pro" value="{{$profile == null ? '' : $profile->avatar}}" id="image_pro">
    <input type="hidden" name="id_hidden" id="id_hidden" value="{{$profile->id}}">
    
</div>
@endsection
@section('script')
    <script>
        (function() {
        'use strict';
        window.addEventListener('load', function() {

           
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {

                    event.preventDefault();
                    event.stopPropagation();

                    if (form.checkValidity() === true) {
                        saveprofile();
                    } 
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        })();

        //submit-profile
       function saveprofile(){
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }

            });
            $.ajax({
                type: "POST",
                url: "{{ route('profile.edit') }}",
                data: {
                    id:$('#id_hidden').val(),
                    firstname:$('#firstname').val(),
                    lastname:$('#lastname').val(),
                    avatar:$('#image_pro').val(),
                    email:$('#email').val(),
                   
                },
                success:function (data) {
                    // alert('Thông tin cá nhân đã được sửa.');
                    location.reload();
                },
                error: function (response) {
                    $('#firstnameErr').text(response.responseJSON.errors.firstname);
                    $('#lastnameErr').text(response.responseJSON.errors.lastname);
                    $('#avatarErr').text(response.responseJSON.errors.avatar);
                    // $('#nameErr').text(response.responseJSON.errors.name);
                    $('#emailErr').text(response.responseJSON.errors.email);
                    
                }
            })
            return false;
        }
    </script>

@endsection
