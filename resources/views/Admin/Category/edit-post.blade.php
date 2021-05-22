@extends('layouts.master')

@section('title') Sửa loại bài viết @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('index.post.category')}}">Danh sách loại</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Sửa lại bài viết</a></li>
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
                        <h1 class="page-header"style=" margin: 0px 0 20px;">Sửa
                            loại bài viết
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12 col-md" style="padding-bottom:120px">
                        <form class="outer-repeater needs-validation" novalidate action="{{route('update.category.post',['id'=>$category->id])}}" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <div class="form-group">
                                <label>Tên danh mục</label>
                               <input class="form-control" name="name" placeholder="Vui lòng nhập..." value=" @if(old('name')){{old('name')}} @else {{$category->name}} @endif" required maxlength="255" />
                               <span class="error-message">{{ $errors->first('name') }}</span>
                               <div class="invalid-feedback"><em></em> Tên danh mục không được để trống</div>
                            </div>
                            <div class="form-group">
                                <label>Miêu tả</label>
                                <textarea name="desc" class="form-control" id="content" rows="10" > @if(old('desc')){{old('desc')}} @else {{$category->desc}} @endif</textarea>
                                <span class="error-message">{{ $errors->first('desc') }}</span>
                            </div>
                             <div class="form-group">
                                <label>Danh mục cha </label>
                                 <select name="parent_id" id="" class="form-control">
                                    <option value="0">Danh mục cha</option>
                                    @foreach($category_id as $category_id)

                                        <option
                                        @if($category->parent_id == $category_id->id)
                                            {{'selected'}}
                                        @endif
                                         value="{{$category_id->id}}">{{$category_id->name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-sm-8 text-sm-center">
                            <button type="submit" class="btn btn-success">Sửa loại bài viết</button>
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
        <!-- plugin js -->
        <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
        
        <!-- jquery.vectormap map -->
        <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
        
        <!-- Calendar init -->
        <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
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
