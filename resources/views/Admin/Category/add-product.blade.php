@extends('layouts.master')

@section('title') Thêm loại danh mục @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.product.category')}}">Danh sách loại</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm loại danh mục</a></li>
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
                            loại danh mục
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form class="outer-repeater needs-validation" action="{{route('post.add.category.product')}}" method="POST" novalidate >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên danh mục (*)</label>
                               <input class="form-control" name="name" value="{{old('name')}}"  placeholder="Vui lòng nhập..." required maxlength="250" />
                               <span class="error-message">{{ $errors->first('name') }}</span>
                               <div class="invalid-feedback"><em></em> Tên danh mục không được để trống</div>
                            </div>
                            <div class="form-group">
                                <label>Miêu tả</label>
                                <textarea name="desc" class="form-control" id="content" rows="10" required>{{old('desc')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <button type="button" id="selectoneimage" class="btn btn-primary select-image">
                                  Chọn ảnh
                                </button>
                                <div id="div_albumb" name="div_albumb" style="padding-top: 20px">
                                     <div id="img_thumb" style="width:200px;height:200px;position:relative;display:none;">
                                        <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                                        <a class="delete_image_box">
                                            <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ngôn ngữ</label>
                                 <select name="lang" id="" class="form-control">
                                  
                                    {{-- {{ dd($category_id) }} --}}
                                    @foreach($lang as $item)
                                        <option
                                   
                                         value="{{ $item->id }}">{{$item->des}}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label>Danh mục cha </label>
                                 <select name="parent_id" id="" class="form-control">
                                    <option value="0">Danh mục cha</option>
                                    <?php showCategories($category) ?>
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Hiện thị ở trang chủ </label>
                                <input type="checkbox" class="chk" name="displayed">
                            </div>
                            <div class="col-sm-8 text-sm-center">
                                <input type="submit" id="" class="btn btn-success" value="Thêm loại danh mục" />
                                <button type="reset" class="btn btn-info">Nhập hết lại</button>
                            </div>
                            <input type="hidden" name ="image_pro" value="" id="image_pro">
                            <input type="hidden" name="albumb_id" value="" id="albumb_id">
                            <input type="hidden" value="" id="link_id" name="link_id">
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <div>
         @include('Admin.modal-image');
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