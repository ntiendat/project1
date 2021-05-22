 <div class="col-lg-4 col-md-4 col-sm-4">      
    <div>
            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Chọn ảnh bài viết</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thư viện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upload file</a>
                            <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                                class="dropzone" id="dropzone">
                                @csrf
                            </form>
                        </li>
                       
                    </ul>
                    <div class="tab-content" id="myTabContent">
                         <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3>filter media</h3>
                            <div class="row" style="position: relative;">
                                <div class="form">
                                    <div class="div-select">
                                        <select name="" id="" class="select-all">
                                            <option value="">Chọn ảnh</option>
                                            <option value="">Tác vụ</option>
                                            <option value="">Tác vụ</option>
                                            <option value="">Tác vụ</option>
                                        </select>
                                    </div> 
                                    <div class="div-select" style="">
                                        <select name="" id=""class="select-all">
                                            <option value="">Tất cả các ngày</option>
                                            <option value="">Tìm theo</option>
                                            <option value="">Tìm theo</option>
                                            <option value="">Tìm theo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class=" div-add" style="">
                                      <input type="text" placeholder="Tìm kiếm...">
                                </div>
                            </div><br>
                            <div class="row img-row">
                                @foreach($media as $media)
                                <div class="col-md-2 text-center"  >
                                    <img id="img_{{$media->id}}" src="../../Media/{{$media->url}}" width="100%" height="100px" alt="">
                                    <input type="checkbox" name="media_id" value="{{$media->id}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row">
                                <div class="col-md-10">
                                    <form method="post" action="{{route('media.store')}}" enctype="multipart/form-data" 
                                        class="dropzone" id="dropzone">
                                    @csrf
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <input type="button" id="add_image" class="btn btn-success"  value="Thêm ảnh">
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" id="btn-oke" class="btn btn-secondary" data-dismiss="modal">Oke</button>
                  </div>

                </div>
              </div>
            </div>
</div>
