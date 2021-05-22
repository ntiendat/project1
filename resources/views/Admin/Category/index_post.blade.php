@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách loại bài viết</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
        <div class="row" style="position: relative;">
            <div class="form div-select">
                <select name="" id="actions" class="select-all">
                    <option value="0">Tác vụ</option>
                    <option value="1" class="delete-all">Xoá</option>
                </select>
            </div> 
            <div class="form div-select" style="">
                <input type="text" placeholder="Tìm kiếm..." id="searchCatepost">
            </div>
           <div class="form div-select " style="">
                <div class="multiselect">
                    <div class="selectBox" onclick="showCheckboxes()">
                      <select>
                        <option>Tùy chọn hiện thị</option>
                      </select>
                      <div class="overSelect"></div>
                    </div>
                    <div id="checkboxes">
                      <div><input type="checkbox" name="ten" />Tên</div>
                      <div><input type="checkbox" name="mieuta" />Miêu tả</div>
                      <div><input type="checkbox" name="danhmuccha" />Danh mục cha</div>
                      <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                    </div>
                    
                  </div>
            </div>
            <div class="form div-add" style="">
                  <a href="{{route('create.category.post')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
            </div>
        </div>
        <br>
         <table id="someTable" class="table table-striped table-hover table-primary" >
                <thead >
                    <tr class="text-center">
                        <th class="checkbox1"> <input type="checkbox"  name="" id="check_all"></th>
                        <th scope="col" class="stt">STT</th>
                        <th scope="col" class="ten">Tên</th>
                        <th scope="col" class="mieuta">Miêu tả</th>
                        <th scope="col" class="danhmuccha">Danh mục cha</th>
                        <th scope="col" class="tacvu">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php tableCategories($category_post) ?>
                </tbody>
            </table>
       
    </div>

    
@endsection
@section('script-bottom')
    <script type="text/javascript">
        $('#searchCatepost').on('keyup',function(){
            $value = $(this).val();
            //alert($value);
            $.ajax({
                type: 'get',
                url: '{{ route('search.cate.post') }}',
                data: {
                    'search': $value,
                },
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        $('#actions').on('change',function() {
                if ($("#actions option:selected").val() == 1) {

                    $("#actions").val(0).change();  
                    var idsArr = [];  

                    $(".checkbox:checked").each(function() {  
                        idsArr.push($(this).attr('data-id'));
                    });  

                    if (idsArr.length <=0)  {  
                        alert("Vui lòng chọn trước khi xoá");  
                    } else {  
                        if(confirm("Bạn có chắc muốn xáo các danh mục bài viết đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-category-post.post')}}',
                                type: 'GET',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: {ids:strIds},
                                success: function (data) {
                                    if (data['status']==true) {
                                        $(".checkbox:checked").each(function() {  
                                            $(this).parents("tr").remove();
                                            
                                        });
                                        alert(data['message']);
                                    } else {
                                        alert('aaa!!');
                                    }

                                },
                                error: function (data) {
                                    alert(data);
                                }

                            });

                        }  

                    }  

            }
        
        });
    </script>
@endsection


