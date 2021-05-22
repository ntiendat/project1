 <div class="col-lg-4 col-md-4 col-sm-4">
    <div class="div-right">
        <div style="margin-left: 5px;border-bottom: 1px solid" >
            <ul>
                
                    @foreach ($lang as $val)
                    <input type="radio" id="lang_{{$val->id}}" @if ($val->id== $product->lang_id) checked @endif name="lang" value="{{$val->id}}">
                    <label for="male">{{$val->des}}</label><br>
                    @endforeach
                
            </ul>
        </div>
    </div>
        <div class="div-right" style="">
            <p class="name-cate" style=" ">Tất cả danh mục</p><hr>
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
                                    >".substr($val->name,0,20)."</span>";
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
                 <span class="error-message" id="category_idErr">{{ $errors->first('category_id') }}</span>
            </div>
            <div id="add-cate">
                <div class="form-group">
                    <label>Tên danh mục</label>
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
                <label for="project-priority">Từ khóa sản phẩm</label>
                <hr>
                <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ..." id="tag_id" name="tag_id" multiple>
                    <option value="-1">--</option>
                    <?php $tag_check = array_column($product_tag->toArray(),'tag_id'); 
                    ?>

                        @foreach ($tag as $key => $value)
                            <option value="{{ $value['id'] }}"
                            @if (array_search($value['id'],$tag_check) > -2)
                                selected="selected"
                            @endif
                            >{{ $value['name'] }}</option>
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

                @if ($product_img == null)
                    <div id="img_thumb" style="width:100%;height:120px;position:relative;display:none;">
                        <img id="img_product" name="img_product" style="padding:5px" alt="" width="100%" height="120px">
                        <a class="delete_image_box">
                            <i class='fas fa-times'  style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;'></i>
                        </a>
                    </div>
                @else 
                    <div id="img_thumb" style="width:100%;height:120px;position:relative;display:inline-block;">
                        <img id="img_product" name="img_product" src="../../../Media/{{$product_img->url}}" style="margin-right:5px" alt="" width="100%" height="120px">
                        <a class="delete_image_box"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;cursor: pointer;' ></i>
                        </a>
                        
                    </div>
                @endif
            </div><br>
            <span class="error-message" id="product_media_idErr"></span>
        </div>
        <div class="div-right" style="" id="album_images">
            <p class="name-cate" style=" ">Albumb sản phẩm</p>
            <hr>
            <!-- Button to Open the Modal -->
            <button type="button" id="selectmultiimage" class="btn btn-primary select-image" >
              Chọn ảnh
            </button>
            <div id="div_albumb">
                @foreach($pro_media as $pro_media)
                    <div class="border-image-product" style="width:91px;height:91px;position:relative;display:inline-block;margin:5px 5px">
                        <img id="media_id" name="media_id" src="../../../Media/{{$pro_media->url}}" style="margin-right:5px" alt="" width="100%" height="100%">
                        <a class="delete_image_box_multi" data-id="{{$pro_media->id}}"><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute;' ></i></a>
                    </div>
                    <input type="hidden" value="{{$pro_media->url}}" id="url">
                @endforeach
                
            </div> <br>
            <span class="error-message" id="media_idErr">{{ $errors->first('name-cate') }}</span>
            
        </div>
        <div>
            @include('Admin.modal-image');
        </div>
        <br><br>
    </div>
</div>
<script>
    // $('#checkbox-image').on('click',function(){
    //     alert('aaa');
    //     if($('input[name=media_id]:checked')){
    //         $('.border-media-product').addClass('.addStyle-imge');
    //         $('.border-media-product').addClass('.addStyle-image-child');
    //     }else{
    //         $('.border-media-product').removeClass('.addStyle-imge');
    //         $('.border-media-product').removeClass('.addStyle-image-child');
    //     }
    // })
</script>