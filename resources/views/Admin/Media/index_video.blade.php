@extends('layouts.master')

@section('title') Thư viện video @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Thư viện video</a></li>
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
    <h3 class="">Chọn thư mục tải ảnh</h3>
     <div class="row">
        <div class="col-md-10">
            <form method="post" action="{{route('media.store.video')}}" enctype="multipart/form-data" 
                class="dropzone" id="dropzone">
            @csrf
            </form>
        </div>
        <div class="col-md-2">
            <input type="button" id="add_video" class="btn btn-success"  value="Thêm Video">
        </div>
    </div>
     <style>
        
    </style>
    <div class="row" style="position: relative;">
        <div class="form">
            <div class="div-select">
                <select name="" id="" class="select-all">
                    <option value="">Tác vụ</option>
                    <option value="">Tác vụ</option>
                    <option value="">Tác vụ</option>
                    <option value="">Tác vụ</option>
                </select>
            </div> 
            <div class="div-select" style="">
                <select name="" id=""class="select-all">
                    <option value="">Tìm theo</option>
                    <option value="">Tìm theo</option>
                    <option value="">Tìm theo</option>
                    <option value="">Tìm theo</option>
                </select>
            </div>
            <div class="div-select" style="">
                <select name="" id=""class="select-all">
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                </select>
            </div>
        </div>
        <div class=" div-add" style="">
              <input type="text" placeholder="Tìm kiếm...">
        </div>
    </div>
    <br>

    <div class="row">
        @foreach($video as $video)
        <div class="col-md-2 img_{{$video->id}} text-center" style="margin-bottom: 10px ">
            <p style="width: 100%"> <video src="{{asset('Media/'.$video->url)}}" style="width: 100%;height: 100px;" alt=""></video></p>
            <a class=" text-center remove_image" onclick="delete_images('{{$video->id}}')" style="color: blue;cursor: pointer;">Xóa video</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('css')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css"> --}}
@endsection
@section('script-bottom')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script> --}}
<script type="text/javascript">
    function delete_images(video_id) {
        // alert(video_id);
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
         $.ajax({
            type:'POST',
            url:"{{route('media.delete.image')}}",
            data:{name:video_id},
            success:function(data){
                // console.log(data);
                if(data['status'] == true){
                    alert('Video đã được xóa !!!')
                }
                $(".img_" + video_id).hide();
            },
            error: function(e) {
                console.log(e);
            }
        })
    }
    $('#add_video').on('click',function(){
           window.location.reload();
        }); 
    Dropzone.options.dropzone =
     {
        maxFiles: 1,
        addRemoveLinks: true,
        maxFilesize: 20,
        acceptedFiles: ".mp4,.mkv,.avi,.mp3",
        addRemoveLinks: true,
        timeout: 50000,
        // accept: function(file, done) {
        //     if (file.width < 100) {
        //        alert("kích thước file quá lớn không thể upload.");
        //     }
        //     else { done(); }
        // },
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        removedfile: function(file) 
        {
            var name = file.upload.filename;
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{ route('media.delete') }}',
                data: {filename: name},
                success: function (data){
                    console.log("File đã được xóa !!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ? 
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) 
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
    };
</script>
@endsection


