@extends('layouts.master')

@section('title') Danh sách bài viết @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách bài viết</a></li>
      </ol>
    </nav>
    <style>
        @font-face {
            font-family:"materialdesignicons-webfont";
            src: url("/fonts/materialdesignicons-webfont.ttf") format("ttf"),
        }
    </style>
    <div id="page-wrapper">
    <div class="row" style="position: relative;">
        <div class="form div-select">
            <select name="" id="actions" class="select-all">
                <option value="0">Tác vụ</option>
                <option value="1" class="delete-all" data-url="">Xoá</option>              
            </select>
        </div> 
        <div class="form div-select" style="">
            <input id="search" type="text" placeholder="Tìm kiếm...">
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
                  <div><input type="checkbox" name="tieude" disabled />Tiêu đề</div>
                  <div><input type="checkbox" name="loai" />Loại</div>
                  <div><input type="checkbox" name="anhbaiviet" />Ảnh bài viết</div>
                  <div><input type="checkbox" name="binhluanbaiviet" />Bình luận bài viết</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
                
              </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('create.post')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
        </div>
    </div>
    <br>
     <table id="someTable" class="table table-striped table-hover table-primary" >
            <thead >
                <tr>
                    <th class="checkbox1"><input type="checkbox"  name="" id="check_all"></th>

                    <th scope="col" class="stt">STT</th>
                    <th scope="col" class="tieude">Tiêu đề</th>
                    <th scope="col" class="loai w10">Loại</th>
                    <th scope="col" class="anhbaiviet w10">Ảnh bài viết</th>
                    <th scope="col" class="binhluanbaiviet w15">Bình luận bài viết</th>
                    <th scope="col" class="tacvu w10">Tác vụ</th>
                </tr>
            </thead>
            <tbody id="tbody">
               <?php 
                    $stt = 1;
                ?>

               @foreach($posts as $post)
               <tr>
                <th class="checkbox1"><input type="checkbox" class="checkbox"  name="" data-id="{{$post->id}}"></th>
                <td class="stt">{{ $stt++ }}</td>
                {{-- <td></td> --}}
                <td> {!! substr($post->title,0,255) !!}</td>
                <td>
                    @if($post->type ==1)
                        {{'Trang'}}
                    @else
                        {{'Bài viết'}}
                    @endif
                </td>
                <td>@if($post->media_id != 0)<img src="{{asset('Media/'.$post->url)}}" alt="" width="50px" height="50px"> @endif
                </td>
                <td> 
                    @if($post->allow_comment == 1)
                      <span style="color: green">{{'Được bình luận'}}</span>
                    @elseif($post->allow_comment == 2)
                      <span style="color: red">{{'Khóa bình luận'}}</span>
                    @endif
                </td>
                <th scope="col" class="tacvu">
                    <a target="_blank" rel="noopener noreferrer" href="{{route('home.list.post',['id'=>$post->id])}}"><i class="fas fa-eye"></i></a>
                    <a href="{{route('edit.post',['id'=>$post->id])}}"><i class="fa fa-edit tacvu"></i></a>
                    <a class="delete" data-id={{$post->id}}><i class="fa fa-trash tacvu" style="color: red"></i></a>

                </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pagination" class="row">{{$posts->links()}}</div>
    </div>
@endsection
@section('script-bottom')
<script type="text/javascript">

            $('.delete').on('click',function(){
              var id=$(this).attr('data-id');
              var tr= $(this).parents("tr");
              if(confirm("Bạn có chắc muốn xoá bài viết")){  
                    $.ajax({
                        url: '{{ route('delete.post') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Bài viết đã được xoá",1);
                        },error: function (data) {
                            showMessage("Bài viết xoá bị lỗi",2);
                        }
                    });
                }
            });

           

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
                        if(confirm("Bạn có chắc muốn xoá các bài viết đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-post.post')}}',
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
<script>
         $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.post') }}',
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        // $('tbody').html(data);
                        $('tbody').html(data.data);
                        $('#pagination').html(data.paginate);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
       
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
                // alert(search_text);
                  $.ajax({
                      type: "GET",
                      url: 'search/post?page=' + page,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: {'search':search_text},
                      success: function (data) {
                        //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                         $('tbody').html(data.data);
                         $('#pagination').html(data.paginate);
                         reloadAjax();
                          
                      }
                  });
              }
        });
    </script>

@endsection


