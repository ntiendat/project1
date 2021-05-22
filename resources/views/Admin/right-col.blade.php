 <div class="col-lg-4 col-md-4 col-sm-4">
    <div class="div-right">
        <div style="margin-left: 5px;border-bottom: 1px solid" >
            <ul>
                
                    @foreach ($lang as $val)
                    <input type="radio" id="lang_{{$val->id}}" name="lang" value="{{$val->id}}">
                    <label for="male">{{$val->des}}</label><br>
                    @endforeach
                
            </ul>
        </div>
    </div>
        <div class="div-right" style="">
            <p class="name-cate" style=" ">Tất cả danh mục</p>
            <hr>
            <div style="margin-left: 5px;border-bottom: 1px solid" >  
               <ul id="myUL">
                <?php
                    buildCategory($category,0);
                    function buildCategory($data,$parent_id){
                        foreach ($data as $val) {
                            if ($val->parent_id == $parent_id) {
                                echo "<li id='cate".$val->id."'><span class='caret'><input type='checkbox' id='category_id' name='' value='".$val->id."'>".$val->name."</span>";
                                echo "<ul class='nested'>";
                                buildCategory($data,$val->id);
                                echo "</li></ul>";
                            }
                        }
                    }
                ?>
                </ul>
                <span class="error-message" id="category_idErr">{{ $errors->first('category_id') }}</span>
            </div>
            <div id="add-cate">
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input class="form-control" id="name_cate_input" name="name_cate_input" placeholder="Vui lòng nhập..." />
                    <span class="error-message"  id="name_cateErr">{{ $errors->first('name-cate') }}</span>
                </div>
                <div class="form-group">
                    <label>Chuyên mục hiện tại </label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">Thư mục lớn</option>
                        <?php showCategories($category_add) ?>
                    </select>
                    <span class="error-message" id="parent_idErr">{{ $errors->first('parent_id') }}</span>
                </div>
                <div class="div-btn-add">
                    <button type="button" id="btn-add-cate" class="btn btn-info">Thêm chuyên mục</button><br><br>
                </div>
            </div>
            <div style="text-align: center;margin: 5px 0">
                <a style="cursor: pointer;color: blue;" id="a-add-cate"><i class="fa fa-plus"></i>Thêm mới danh mục</a>
                
            </div>
            {{-- <a href="#" id="a-add-cate" style="margin-left: 5px;right: 33%;position: absolute;margin-top: 11px;"><i class="fa fa-plus"></i>Thêm mới danh mục</a> --}}
        </div>
        <div class="div-right" style="">
            {{-- <p class="name-cate" style=" ">Từ khóa sản phẩm</p> --}}
            <div class="form-group">
                <label for="project-priority">Tag</label>
                <hr>
                <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ..." id="tag_id" name="tag_id" multiple>
                    <option value="-1">--</option>
                    @foreach($tag as $item)
                    <option value={{ $item['id'] }}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
                <span class="error-message" id="tag_idErr">{{ $errors->first('tag_id') }}</span>
            </div>
          <br><br>
        </div>
        <div class="div-right" style="">
            <p class="name-cate" style=" ">Ảnh sản phẩm</p>
            <hr>
            <!-- Button to Open the Modal -->
            <button type="button" id="selectoneimage" class="btn btn-primary select-image">
              Chọn ảnh
            </button>
            <div>
                <div id="img_thumb" style="width:100%;height:120px;position:relative;display:none;">
                    <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                    <a class="delete_image_box">
                        <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                    </a>
                </div>
            </div><br>
        </div>
        <div class="div-right" style=";" id="album_images">
            <p class="name-cate" style=" ">Albumb sản phẩm</p>
            <hr>
            <!-- Button to Open the Modal -->
            <button type="button" id="selectmultiimage" class="btn btn-primary select-image" >
              Chọn ảnh
            </button>
             <div id="div_albumb" name="div_albumb">
                <span class="error-message" id="media_idErr">{{ $errors->first('div_albumb') }}</span>
            </div>
        </div>
        <div>
            @include('Admin.modal-image');
        </div>
        <br><br>
</div>
<script>
    
</script>