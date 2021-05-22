<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">CHỌN ẢNH</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
       <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link upload_image" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tải ảnh mới lên</a>
                <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                    class="dropzone" id="dropzone">
                    @csrf
                </form>
            </li>
            <li class="nav-item">
                <a class="nav-link library_image active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thư viện</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade library_image active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row" style="position: relative;">
                    <div class="form">
                        {{-- <div class="div-select">
                            <p class="select-all btn btn-primary">Chọn tất cả</p>
                        </div>  --}}
                        <div class="div-select ">
                            <select name="select-all" id="select-all"{{--  class="select-all" --}} style="padding: 5px;border-radius: 5px;">
                                <option value="0">Tác vụ</option>
                                {{-- <option value="2">Chọn nhiều</option> --}}
                                <option value="1">Xóa</option>
                            </select>
                        </div> 
                    </div>
                    <div class=" div-add" style="">
                          <input type="text" placeholder="Tìm kiếm..." style="padding: 5px;border-radius: 5px;">
                    </div>
                </div><br>
                <div class="row img-row">
                    @foreach($media as $media)
                        <div class="col-md-2 text-center border-media-product border-media-product_{{$media->id}}"  >
                            
                            <img id="img_{{$media->id}}" src="{{asset('/Media/'.$media->url)}}" width="100%" height="100px" alt="">
                            <input type="checkbox" name="media_id" class="checkbox-image checkbox" data-id="{{$media->id}}" value="{{$media->id}}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade upload_image" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                            class="dropzone" id="dropzone">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" id="btn-oke" class="btn btn-secondary" data-dismiss="modal">Chọn Ảnh</button>
      </div>
    </div>
  </div>
</div>
