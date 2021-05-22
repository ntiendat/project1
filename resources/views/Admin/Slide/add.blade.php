@extends('layouts.master')
@section('content')
@section('title') Thêm Slide @endsection
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('index.slide')}}">Danh sách slide</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="#">Thêm Slide</a></li>
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
                    Slide
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12 col-md" >
                <form  method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Ảnh slide *</label>
                        <button type="button" id="selectoneimage" class="btn btn-primary">
                              Chọn ảnh
                          </button>

                          <div id="" name="" >
                           <div id="img_thumb" style="width:120px;height:120px;position:relative;display:none;">
                                <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                                <a class="delete_image_box">
                                    <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                                </a>
                            </div>
                            <span class="error-message" id="img_productErr" style="display: none;"><em class="icon-error"></em> Ảnh không được để trống</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Đường dẫn khi click vào slide</label>
                            <input class="form-control" name="url" id="url" placeholder="Nhập đường dẫn" />
                            <span class="error-message" id="urlErr">{{$errors->first('url')}}</span>

                        </div>
                        @include('Admin.modal-image');
                    
                     
                  
            
                <div class="col-sm-8 text-sm-center " style="margin-left: 13px;"> 
                    <input type="button" id="submit-add-slide" class="btn btn-success"  value="Thêm slide">&nbsp;
                    <button type="reset" class="btn btn-info" value="Reset">Nhập hết lại</button>
                </div>
                </div>
                </form>
            </div>
    </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->

<input type="hidden" id="image_pro" value=""> 
@endsection
@section('script')
<script>
    $('#submit-add-slide').on('click',function(){
        var name = $('#name').val();
        var url = $('#url').val();
        var media_id = $("#image_pro").val();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $.ajax({
            type: "POST",
            url: "{{ route('add.slide') }}",
            data: {
                name:name,
                url:url,
                media_id:media_id,
            },
            success:function (data) {
                window.location.href ='{{route('index.slide')}}';
                // alert('Thêm slide thành công');
            },
            error: function (response) {
                $('#nameErr').text(response.responseJSON.errors.name);
                $('#urlErr').text(response.responseJSON.errors.url);
                $('#img_productErr').show();
            }
        })
        return false;
    })

    // $('#btn-oke-slide').on('click',function(){
    //     var $boxess = $('input[name=media_id]:checked');
    //     var id_img;
    //     $('#img_product').empty();
    //     $boxess.each(function(){
    //         img_id = $(this).val();
    //                 ///Do stuff here with this
    //                 var img = "<br><img src='" + $('#img_' + img_id).attr("src") + "' width='150px' height='150px'>";
    //                 $('#img_product').append(img);
    //             });
    //     $('#hidden_media').val($boxess.val());
    // });
</script>
@endsection



