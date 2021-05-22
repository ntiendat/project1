 <div class="col-lg-4 col-md-4 col-sm-4">
     
        <div class="div-right" style="">
            <p class="name-cate" style=" ">Tất cả danh mục</p>
            <hr>
            <div style="margin-left: 5px;border-bottom: 1px solid">  
               <ul id="myUL">
                <?php
                    $cate_check = array_column($category_old->toArray(),'category_id');
                    //var_dump($cate_check);

                    buildCategory($category,0,$cate_check);
                    function buildCategory($data,$parent_id,$cate_check){
                        foreach ($data as $val) {
                            if ($val->parent_id == $parent_id) {
                                //var_dump(in_array($val->id , $cate_check) + 1);
                                if (in_array($val->id , $cate_check) == 2){
                                    echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' checked id='category_id' name='' value='".$val->id."'
                                    >".$val->name."</span>";
                                    echo "<ul class='nested'>";
                                    buildCategory($data,$val->id,$cate_check);
                                    echo "</li></ul>";
                                }else{
                                     echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' id='category_id' name='' value='".$val->id."'
                                       
                                    >".$val->name."</span>";
                                    echo "<ul class='nested'>";
                                    buildCategory($data,$val->id,$cate_check);
                                    echo "</li></ul>";
                                }
                            }
                        }
                    } 
                ?>
                </ul>
                
            </div>
            <div id="add-cate">
                <div class="form-group">
                    <label>Tên danh mục</label><hr>
                    <input class="form-control"  id="name-cate-input" name="name-cate-input" value="" placeholder="Vui lòng nhập..." />
                    <span class="error-message" id="name_cateErr">{{ $errors->first('name-cate') }}</span>
                </div>
                <div class="form-group">
                    <label>Chuyên mục hiện tại </label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">Thư mục lớn</option>
                        <?php showCategories($category_add) ?>
                    </select>
                </div>
                <div class="div-btn-add">
                    <button type="button" id="btn-add-cate" class="btn btn-info">Thêm chuyên mục</button><br><br>
                </div>
            </div>
            <div style="text-align: center;margin: 5px 0">
                <a style="cursor: pointer;color: blue;" id="a-add-cate"><i class="fa fa-plus"></i>Thêm mới danh mục</a>
                
            </div>
           
        </div>
        <div class="div-right" style="">
            <div class="form-group">
                <label for="project-priority">Từ khóa sản phẩm</label><hr>
                <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ..." id="tag_id" name="tag_id" multiple>
                    <option value="-1">--</option>
                    <?php $tag_check = array_column($tag_link->toArray(),'link_id'); ?>
                        @foreach ($tag as $key => $value)
                            <option value="{{ $value['id'] }}"
                            @if (array_search($value['id'],$tag_check) > -2)
                                selected="selected"
                            @endif
                            >{{ $value['name'] }}</option>
                        @endforeach
                </select>
            </div>
          <br><br>
        </div>
        <div class="div-right" >
            <p class="name-cate" style=" ">Ảnh bài viết</p><hr>
            <!-- Button to Open the Modal -->
            <button type="button" id="selectoneimage" class="btn btn-primary select-image">
              Chọn ảnh
            </button>
            <div id="div_albumb">
                @if ($post_img == null)
                    <div id="img_thumb" style="width:100%;height:120px;position:relative;display:none;">
                        <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                        <a class="delete_image_box">
                            <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i></a>
                        </div>
                @else 
                    <div id="img_thumb" style="width:100%;height:120px;position:relative;display:inline-block;">
                        <img id="img_product" name="img_product" src="../../../Media/{{$post_img->url}}" style="margin-right:5px" alt="" width="100%" height="120px">
                        <a class="delete_image_box"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;cursor: pointer;' ></i></a>
                        
                    </div>
                @endif
                
            </div>
            <span class="error-message" id="img_productErr">{{$errors->first('name')}}</span>
            <br>
        </div>
        <div>
            <!-- The Modal -->
            {{-- <div class="modal fade" id="myModal">
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
                                    <img id="img_{{$media->id}}" src="../../../Media/{{$media->url}}" width="100%" height="100px" alt="">
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
            </div> --}}
            @include('Admin.modal-image');
          </div>
        <br><br>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css"> --}}