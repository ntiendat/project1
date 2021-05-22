@extends('layouts.master')

@section('title') Thông tin sản phẩm @endsection

@section('content')
     <nav aria-label="breadcrumb" style="z-index: 1000">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách sản phẩm</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
    <div class="row" style="position: relative;">
        <div class="form div-select">
            <select name="" id="actions" class="select-all">
                <option value="0">Tác vụ</option>
                <option value="1" class="delete-all" data-url="">Xoá</option>  
            </select>
        </div> 
         <!-- <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button> -->
        <div class="form div-select" style="">
            <input id="search" type="text" placeholder="Tìm kiếm... ">
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
                  <div><input type="checkbox" name="anhsanpham"  />Ảnh</div>
                  <div><input type="checkbox" name="tieude" disabled />Tiêu đề</div>
                  <div><input type="checkbox" name="danhmuc" disabled />Danh mục</div>
                  <div><input type="checkbox" name="gia1" />Giá gốc</div>
                  <div><input type="checkbox" name="gia" />Giá giảm</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
                
              </div>
        </div>
        <div class="form div-select" style="">
              {{-- <a href="{{route('list.process')}}" style="margin-bottom: 5px"> Danh sách đơn hàng đã được xử lý</a>  --}}
              <span class="tatcatrangthai">Danh mục</span>
              <select name="status_category_product" class="form-control" id="category_id" onchange="searchCategory()">
                  <option value="0">Chọn Danh mục</option>
                    @foreach($categorys as $key => $category)
                        <option
                                @if(isset($category_id) && ($category->id == $category_id))
                                    {{'selected'}}
                                @endif
                             value="{{$category->id}}">{{$category->name}}
                        </option>
   
                    @endforeach
              </select>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('create.product')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
        </div>
    </div>
    <br>
   
     <table id="someTable"  class="table table-striped table-hover table-primary">
            <thead >
                <tr>
                    <th class="checkbox1"><input type="checkbox"  id="check_all"></th>
                    <th scope="col" class="stt">STT</th>
                    <th scope="col" class="anhsanpham" style="width: 50px;text-align: center;">Ảnh</th>
                    <th scope="col" class="tieude">Tiêu đề</th>
                    <th scope="col" class="danhmuc">Danh mục</th>
                    <th scope="col" class="gia1 w10">Gía gốc</th>
                    <th scope="col" class="gia w10">Gía giảm</th>
                    <th scope="col" class="tacvu">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt =1 ?>
                @foreach($products as $product)
               
                <tr>
                    <th class="checkbox1"><input type="checkbox" name="check_all" class="checkbox" value="{{$product->id}}" data-id="{{$product->id}}"></th>
                    <th scope="col" class="stt">{{$stt++}}</th>
                    <th scope="col">  @if($product->product_media_id != 0)<img src="{{asset('Media/'.$product->url)}}" alt="" width="50px" height="50px"> @endif</th>
                    <th scope="col">{{ substr($product->title,0,255)}}</th>
                    <th scope="col">{{$product->name}}</th>

                    <th scope="col" class="gia">{{number_format($product->price)}}<sup>đ</sup></th>
                    <th scope="col" class="gia">{{number_format($product->promotion_price)}}<sup>đ</sup></th>
                    <th scope="col" class="tacvu">
                        <a target="_blank" rel="noopener noreferrer" href="{{route('home.list.product',['id'=>$product->id])}}"><i class="fas fa-eye"></i></a>
                        <a href="{{route('edit.product',['id'=>$product->id])}}"><i class="fa fa-edit tacvu"></i></a>
                        <a class="delete" data-id={{$product->id}}><i class="fa fa-trash tacvu" style="color: red"></i></a>
                    </th>
                </tr>

                @endforeach
            </tbody>
        </table>
    <div id="pagination" class="row">{{ $products->appends(Request::all())->links() }}</div>
</div>

<script src="{{asset('client/js/jquery.min.js')}}"></script>

@endsection
@section('script')
<script type="text/javascript">

    $('#category_id').on('change',function(e) {
            
            var category_id = $('#category_id option:selected').val();
            
            var url = '{{ route("filter", ":id") }}';
            url = url.replace(':id', category_id);
            window.location.href = url;

    });
 
    

    $('#search').on('keyup',function(){
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route('search') }}',
            data: {
                'search': $value
            },
            success:function(data){
                console.log(data);
                $('tbody').html(data.data);
                $('#pagination').html(data.paganate);

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
                if(confirm("Bạn có chắc muốn xoá tất cả các sản phẩm")){  
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: '{{route('delete-multiple-product.product')}}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();

                                    
                                });
                                alert(data['message']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        $('#pagination').html(data.paganate);
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

<script>
       


        function deleteproduct(e,id){
            var tr= $(e).parents("tr");
              if(confirm("Bạn có chắc muốn xoá sản phẩm")){  
                    $.ajax({
                        url: '{{ route('delete.product') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            //console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Sản phẩm đã được xoá",1);
                        },error: function (data) {
                            showMessage("Sản phẩm xoá bị lỗi",2);
                        }
                    });
                }
        }

        $('.delete').on('click',function(){
              var id=$(this).attr('data-id');
              var tr= $(this).parents("tr");
              if(confirm("Bạn có chắc muốn xoá sản phẩm")){  
                    $.ajax({
                        url: '{{ route('delete.product') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            //console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Sản phẩm đã được xoá",1);
                        },error: function (data) {
                            showMessage("Sản phẩm xoá bị lỗi",2);
                        }
                    });
                }
            });
        //click vao 
        $(document).ready(function() {
            //click vao class pagination class a sinh ra khi phan trang

            $(document).on('click', '.pagination a', function(e){

                var search_text = $('#search').val();
                
                // alert($value);
                e.preventDefault();
                //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                var page = $(this).attr('href').split('page=')[1];

                fetch_data_search(search_text,page);
                
            });

             function fetch_data_search(search_text,page)
              {

                     $.ajax({
                      type: "GET",
                      url: 'search?page=' + page,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: {'search':search_text},
                      success: function (data) {\
                        console.log(data);
                        //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                         $('tbody').html(data.data);
                         $('#pagination').html(data.paganate);
                         
                          
                      }
                  });
              }
        });
    </script>

@endsection

