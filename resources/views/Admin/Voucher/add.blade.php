@extends('layouts.master')

@section('title') Thêm sản phẩm @endsection
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.post')}}">Danh sách voucher</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm voucher</a></li>
  </ol>
</nav>
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"style=" margin: 0px 0 20px;">Thêm
                        Voucher
                    </h1>
                </div>
            </div>
            <form class="outer-repeater needs-validation" action="{{route('addvoucher')}}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                <div>                
                            <div>
                                <div class="form-group">
                                    <label class="abc col-lg-2" for="lname">Code</label>
                                    <input class="form-control col-lg-12" id="code" name="code" maxlength="12" required placeholder="code">
                                    <div class="invalid-feedback"> <em></em>code không đúng</div>
                                </div>
                            </div>
                        	<div>
                        		<div class="form-group">
                                    <label class="abc col-lg-2" for="lname">Tên Voucher</label>
                                    <input class="form-control col-lg-12 " type="text" id="voucher" name="voucher"   placeholder="voucher" required  maxlength="255">
                                    <div class="invalid-feedback"> <em></em> Tên voucher không hợp lệ</div>
                                </div>
                            </div>
                        	<div>
                        		<div class="form-group">
                                   <label class="abc col-lg-2"  for="country">Miêu tả</label>
                                   <input class="form-control col-lg-12 " type="text" id="description" name="description" placeholder="description" required maxlength="255">
                                   <div class="invalid-feedback"> <em></em> Miêu tả không hợp lệ</div>
                                </div>
                            </div>
                        	<div>
                        		<div class="form-group">
                                    <label class="abc col-lg-3" for="address">Số người tối đa sử dụng</label>
                                    <input  type="number" placeholder="Maximum user using"  id="max_uses" name="max_uses" class="form-control col-lg-12 " required   />
                                    <div class="invalid-feedback"> <em></em> Số người sử dụng tối đa không đúng</div>
                                </div>
                                
                            </div>

                            <div>
                        		<div class="form-group">
                                    <label class="abc col-lg-2" for="address">Giảm giá</label>
                                    <input type="text" placeholder="Discount" class="form-control col-lg-12" id="discount_amount" name="discount_amount" required   />
                                    <div class="invalid-feedback"> <em></em> Giảm giá không đúng</div>
                                </div>

                            </div>
                            <div class="col-lg-12 option  ">
                                    <label class="abc col-lg-2" for="address">Loại</label>
                                    <select style="width: 100%;" id="type" name="type" class="form-control selector" required="">
                                           <option value="1">Giảm theo phẩn trăm</option>
                                           <option value="2">Giảm theo tiền</option>
                                     </select>
                                     
                                </div><br>

                        	<div class="form-group">
                                  <label class="abc col-lg-2" for="address">Thời gian bắt đầu</label>
                                  <input class="form-control col-lg-12"  type="date" name="date_start" value="{{date('Y-m-d')}}" required>
                            </div>

                            <div class="form-group">
                                  <label class="abc col-lg-2" for="address">Thời gian kết thúc</label>
                                 <input class="form-control col-lg-12"  type="date" name="date_end" value="{{date('Y-m-d')}}" required >
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <button  id="submit" type="submit" class="btn btn-success">Thêm voucher</button>
                            </div>
                </div>
            </form>
        </div>
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
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script> 

@endsection