
@extends('layouts.master')
@section('content')
@section('title') Thêm Form @endsection
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.form')}}">Danh sách form</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm form</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
</ol>
</nav>
<style type="text/css">
    .error-message { color: red; }
    #media_img{
        color: red;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                    form
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12 col-md" >
                <form class="outer-repeater needs-validation"  method="POST"  action="" novalidate >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Email nhận (*)</label>
                        <input class="form-control" name="email_to" id="email_to" {{old('email_to')}} placeholder="Vui lòng nhập..." required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  />
                        <span class="error-message" id="nameErr">{{$errors->first('email_to')}}</span>
                        <div class="invalid-feedback"><em></em> Email sai định dạng</div>
                    </div>
                    <div class="form-group">
                        <label>Tên form (*)</label>
                        <input class="form-control" name="name" id="name" {{old('name')}} placeholder="Vui lòng nhập..." required />
                        <span class="error-message" id="nameErr">{{$errors->first('name')}}</span>
                        <div class="invalid-feedback"><em></em> Nhập tên Form</div>
                    </div>
                    <div class="form-group">
                        <label>Gía trị</label>
                        <textarea name="content" id="content" rows="10">{{$form}}</textarea>
                        <span class="error-message" id="valueErr">{{$errors->first('content')}}</span>
                    </div>
                    <div class="col-sm-8 text-sm-center">
                        <button type="button" id="add-form" class="btn btn-success">Thêm Form</button>
                        <button type="reset" class="btn btn-info">Nhập hết lại</button>
                    <div class="col-sm-8 text-sm-center">
                </form>
            </div>
        </div>
    </div>
</div>
<form>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
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
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    $('#add-form').on('click',function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('add.form') }}",
            data: {
                email_to:$('#email_to').val(),
                content:CKEDITOR.instances['content'].getData(),
                name:$('#name').val(),
            },
            success:function (data) {
                console.log(data);
                notify("<div style='font-size:15px'><i class='fa fa-check'></i> Form đã được thêm </div>",'success');
                window.location.href ='{{route('index.form')}}';
            },
            error: function(response) {
                console.log(response);
                // $('#titleErr').show();
                // $('#contentErr').text(response.responseJSON.errors.content);
                // $('#priceErr').text(response.responseJSON.errors.price);
                // $('#promotion_priceErr').text(response.responseJSON.errors.promotion_price);
                // $('#product_media_idErr').text(response.responseJSON.errors.product_media_id);
                // $('#category_idErr').text(response.responseJSON.errors.category);
                // $('#media_idErr').text(response.responseJSON.errors.media_id);
                // $('#tag_idErr').text(response.responseJSON.errors.tag);
                // $('#parent_idErr').text(response.responseJSON.errors.parent_id);
                // $('#mobileNumberError').text(response.responseJSON.errors.mobile_number);
                // $('#aboutError').text(response.responseJSON.errors.about);
           }
        })
    })


</script>
@endsection