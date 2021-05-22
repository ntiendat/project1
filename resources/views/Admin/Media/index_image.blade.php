@extends('layouts.master')

@section('title') Thư viện ảnh @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Thư viện ảnh</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach ($errors->all() as $error)
       <li><span class="error-message" style="color: red">{{ $error }}</span>}</li>
      @endforeach
     </ul>
    </div>
   @endif
    <span class="error-message">{{ $errors->first('file') }}</span>
    <h3 class="" style="display: inline-block;margin-right: 20px">Chọn thư mục tải ảnh</h3>
    <input type="button" value="Upload" class="btn btn-primary" id="btn-upload"><hr>
    <div class="row row-dropzone"  style="display: none;" >
        <div class="col-md-12">
            <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                class="dropzone" id="dropzone">
            @csrf
            </form>
        </div>
        {{-- <div class="col-md-2">
            <input type="button" id="add_image" class="btn btn-success"  value="Thêm ảnh">
        </div> --}}
    </div>
   
    <div class="row" style="position: relative;">
        <div class="form">
            <div class="div-select">
                <select name="select-all" id="select-all"{{--  class="select-all" --}} style="padding: 5px;border-radius: 5px;">
                    <option value="0">Tác vụ</option>
                    <option value="2">Chọn nhiều</option>
                    <option value="1">Xóa</option>
                </select>
                {{-- <label for="" id="action" style="color: blue;cursor: pointer;">Chọn nhiều</label> --}}
            </div> 

           {{--  <div class="div-select" style="">
               <p id="action">chọn nhiều</p>
            </div> --}}
            {{-- <div class="div-select" style="">
                <select name="" id=""class="select-all">
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                </select>
            </div> --}}
        </div>
        <div class=" div-add" style="">
              <input type="text" placeholder="Tìm kiếm..."style="padding: 5px;border-radius: 5px;">
        </div>
    </div>
    <br>
    <div class="row img-row-media">
        @foreach($index_media as $index_media)
            @if($index_media->id ==208)
                <div class="col-md-1 img_{{$index_media->id}} text-center" style="margin-bottom: 10px " id="">
                    <p style="width: 100%;margin-bottom: 0"><img src="{{asset('Media/'.$index_media->url)}}" style="width: 100%;height: 50px;" alt=""></p>
                    {{-- <input type="checkbox" id="checkbox-image" style="display: none"> --}}
                    <p class=" text-center">Avatar</p>
                </div>
            @else
                <div class="col-md-1 img_{{$index_media->id}} image-media" style="margin-bottom: 10px;text-align: center;" id="">
                    <p style="width: 100%"><img src="{{asset('Media/'.$index_media->url)}}" style="width: 100%;height: 50px;" alt=""></p>
                    <input type="checkbox" class="checkbox-image checkbox" data-id="{{$index_media->id}}" style="display: none;margin:auto">
                    <a class=" text-center remove_image" onclick="_delete_image('{{$index_media->id}}')" style="color: blue;cursor: pointer;">Xóa ảnh</a>
                </div>
            @endif
        <input type="hidden" value="{{$index_media->url}}" id="url">
        @endforeach
    </div>
</div>
@endsection

@section('script-bottom')
<script>
    function _delete_image(image_id) {
        // alert(image_id);
        url = $('#url').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
         $.ajax({
            type:'POST',
            url:"{{route('media.delete.image')}}",
            data:{name:image_id,url:url},
            success:function(data){
               // notify("<div style='font-size:15px'><i class='fa fa-check'></i> Đã xóa file ảnh " +data+ "</div>",'error');
                $(".img_" + image_id).hide();
            },
            error: function(e) {
                console.log(e);
            }
        })
    }
    $('#btn-upload').on('click',function(){
        $('.row-dropzone').toggle();
        $('.dropzone').val('');

    })
    $('#select-all').on('change',function(){
        if($("#select-all option:selected").val() == 2) {
            if($('.checkbox-image').is(":hidden")){
                $('.checkbox-image').css('display','block');
                $('#select-all').prop('selectedIndex',0);
            }else{
                $('.image-media').removeClass('addStyle-imge');
                $('.checkbox-image').prop('checked', false);
                $('.checkbox-image').css('display','none');
                $('#select-all').prop('selectedIndex',0);
            }
            
        }
        if ($("#select-all option:selected").val() == 1) {
            $("#select-all").val(0).change();  
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  
            if (idsArr.length <=0)  {  
                alert("Vui lòng chọn trước khi xoá");  
            } else {  
                if(confirm("Bạn có chắc muốn xoá các ảnh đã chọn")){  
                    var strIds = idsArr.join(","); //join: lấy hết giá trị bên trong của biến khi được join
                    // alert(strIds);
                    $.ajax({
                        url: '{{route('delete.multiple.image.media')}}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {ids:strIds},
                        success: function (data) {
                            $(".checkbox:checked").each(function() {  
                                $(this).parents(".image-media").remove();
                            });
                            notify("<div style='font-size:15px'><i class='fa fa-check'></i>Ảnh được chọn đã được xóa</div>",'error');

                        },
                        error: function (data) {
                            alert(data);
                        }

                    });

                }  

            }  

        }

    })
</script>
@endsection



