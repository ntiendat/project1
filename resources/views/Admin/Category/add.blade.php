@extends('layouts.master')

@section('title') Thêm loại danh mục @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('index.post.category')}}">Danh sách loại</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm loại danh mục</a></li>
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
                            loại danh mục
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form class="outer-repeater needs-validation" action="{{route('category.add')}}" method="POST"  novalidate >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên danh mục (*)</label>
                               <input class="form-control" name="name" value="{{old('name')}}"  placeholder="Vui lòng nhập..." required maxlength="250" />
                               <span class="error-message">{{ $errors->first('name') }}</span>
                               <div class="invalid-feedback"><em></em> Tên danh mục không được để trống</div>
                            </div>
                            <div class="form-group">
                                <label>Miêu tả</label>
                                <textarea name="desc" class="form-control" id="content" value="" rows="10" required>{{old('desc')}}</textarea>
                                <span class="error-message">{{ $errors->first('desc') }}</span>
                                 <div class="invalid-feedback">Nhập miêu tả</div>
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha </label>
                                 <select name="parent_id" id="" class="form-control">
                                    <option value="0">Danh mục cha</option>
                                    <?php showCategories($category) ?>
                                </select>
                            </div>
                            <input type="hidden" name="type" value="{{$type}}">
                            <div class="col-sm-8 text-sm-center">
                            <button type="submit" class="btn btn-success">Thêm loại danh mục</button>
                            <button type="reset" class="btn btn-info">Nhập hết lại</button>
                            </div>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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