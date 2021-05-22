@extends('layouts.master')

@section('title') Danh sách bình luận @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách bình luận</a></li>
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
                      <div><input type="checkbox" name="tieude" />Tiêu đề</div>
                      <div><input type="checkbox" name="noidung" />Nội dung</div>
                      <div><input type="checkbox" name="danhgia" />Đánh giá</div>
                      <div><input type="checkbox" name="baiviet" />Bài viết</div>
                      <div><input type="checkbox" name="trangthai" />Trạng thái</div>
                      <div><input type="checkbox" name="thaydoitrangthai" />Tác vụ</div>
                    </div>
                    
                  </div>
            </div>
            <div class="form div-add" style="">
                <span class="tatcatrangthai"> Trạng thái </span>
                <select name="status-comment2" class="form-control abc" id="status-comment2" >
                    <option value="0">--</option>
                    <option value="1">Chờ duyệt</option>
                    <option value="2">Duyệt</option>
                </select>
            </div>
        </div>
        <br>
        <table id="someTable" class="table table-striped table-hover table-primary" >
            <thead>
                <tr>
                    <th class="checkbox1"><input type="checkbox" id="check_all"  name=""></th>
                    <th scope="col" class="stt">STT</th>
                    <th scope="col" class="tieude">Tiêu đề</th>
                    <th scope="col" class="noidung">Nội dung</th>
                    <th scope="col" class="baiviet">Bài viết</th>
                    <th scope="col" class="trangthai">Trạng thái</th>
                    <th scope="col" class="thaydoitrangthai">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
               <?php 
                    $stt = 1;
                ?>
               @foreach($comments as $comment)
               <tr>
                    <th class="checkbox1"><input type="checkbox" class="checkbox"  name="" data-id="{{$comment->id}}"></th>
                    <td class="stt">{{ $stt++ }}</td>
                    <td>{{ $comment->title_comment}}</td>
                    <td>{{ $comment->content}}</td>
                    <td>{!! substr($comment->title,0,50) !!}</td>
                    <td>
                        <select name="status-comment" class="form-control optionstatus" data-id="{{$comment->id}}">
                            <option value="0">--</option>
                            <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>Chờ duyệt</option>
                            <option value="2" {{ $comment->status == 2 ? 'selected' : '' }}>Duyệt</option>
                        </select>
                    </td>
                    <td class="thaydoitrangthai">
                       
                        <a class="delete" data-id='{{ $comment->id}}' ><i class="fa fa-trash tacvu" style="color: red"></i></a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pagination">{{$comments->links()}}</div>
    </div>
@endsection
@section('script-bottom')
<script type="text/javascript">

    $('.delete').on('click',function() {
        var id = $(this).attr('data-id');
        var tr = $(this).parents("tr");
        if(confirm("Bạn có chắc muốn xoá bình luận bài viết")){  
            $.ajax({
                url: '{{ route('delete.comment') }}',
                type: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {id:id},
                success: function (data) {
                    // console.log($(this).parents("tr"));
                    tr.remove();
                    showMessage("Đã xoá bình luận",1);
                },error: function (data) {
                    showMessage("Đã xoá bình luận lỗi",2);
                }
            });
        }
    });


    $('#status-comment2').on('change',function(){
        
        var status = $("#status-comment2 option:selected").val();
        
        $.ajax({
            url: '{{ route('list.comment.post')}}',
            type: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'status': status},
            success:function(data){
                 $('tbody').html(data.data);
                 $('#pagination').html(data.paging);
                 reloadAjax();
               
            },
            error: function(data){
                alert(data);
            }

        });
    });

    function saveStatus(id,status) {
       
        $.ajax({
            url: '{{route('update.status.comment.post')}}',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {id:id,status:status},
            success: function (data) {
               //console.log(data);
               showMessage('Trạng thái được cập nhật',1)
               //location.reload();
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    //chon id , status_id trog trang thai
    $(".optionstatus").on('change',function(){
      
        var id = $(this).attr('data-id');
        var status = $(this).val();
        //alert($(this).val());
        // alert(id);
        saveStatus(id,status)
    });


    function reloadAjax() {

        $(".optionstatus").on('change',function(){
      
            var id = $(this).attr('data-id');
            var status = $(this).val();
            // alert($(this).val());
            // alert(id);
            //alert(status);

            saveStatus(id,status)

        });
    }

    

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
                        url: '{{route('delete-multiple-Comment-pendding')}}',
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
    // //tim kiem bang ten ,email ,dia chi,sdt
            $('#search').on('keyup',function(){
                $value = $(this).val();
                $status_comment = $('#status-comment1').val();
                //alert($value);
                $.ajax({
                    type: 'get',
                    url: '{{ route('searchComment.post') }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        $('tbody').html(data.data);
                        $('#pagination').html(data.paging);
                        reloadAjax();
                    }
                });
            })
</script>
 <script>
        //click vao 
        $(document).ready(function() {
            //click vao class pagination class a sinh ra khi phan trang
            $(document).on('click', '.pagination a', function(e){
                var search_text = $('#search').val();
                
                var status = $("#status-comment2 option:selected" ).val();

                //alert(status);
                if (status != 0) {
                  //xu li mot lenh truoc khi tiep tuc 1 lenh click moi
                  e.preventDefault();
                  //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                  var page = $(this).attr('href').split('page=')[1];
                  fetch_data(page);
                }else {
                  // alert($value);
                  e.preventDefault();
                  //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                  var page = $(this).attr('href').split('page=')[1];

                  fetch_data_search(search_text,page);
                }
                
            });
            //chuyen trang trong tim kiem khi tim kiem bang thanh trang thai
            function fetch_data(page)
            {     
                //alert(page);
                
                var status = $("#status-comment2 option:selected" ).val();
                //alert(status);
                $.ajax({
                    type: "GET",
                    url: 'list-commnet-post?page=' + page,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'status':status},
                    success: function (data) {
                      //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                       $('tbody').html(data.data);
                       $('#pagination').html(data.paging);
                       reloadAjax();
                        
                    }
                });
            }

             function fetch_data_search(search_text,page)
              {
                //alert(search_text);
                  $.ajax({
                      type: "GET",
                      url: 'searchCommentpost?page=' + page,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: {'search':search_text},
                      success: function (data) {
                        //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                         $('tbody').html(data.data);
                         $('#pagination').html(data.paging);
                         reloadAjax();                         
                      }
                  });
              }
        });
    </script>

@endsection


