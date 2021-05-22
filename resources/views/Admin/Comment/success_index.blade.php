@extends('layouts.master')

@section('title') Danh sách bình luận đã duyệt @endsection

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
            <input type="text" placeholder="Tìm kiếm...">
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
                  <div><input type="checkbox" name="thaydoitrangthai" />Thay đổi trạng thái</div>
                </div>
                
              </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('pendding.index.comment')}}" style="margin-bottom: 5px">Danh sách bình luận chờ duyệt</a>  
        </div>

      </div>
      <br>
      <table id="someTable" class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
        <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
            <tr>
                <th><input type="checkbox" id="check_all"  name=""></th>
                <th scope="col">STT</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Đánh giá</th>
                <th scope="col">Bài viết</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thay đổi trạng thái</th>
            </tr>
        </thead>
        <tbody>
           <?php 
                $stt = 1;
            ?>
           @foreach($comments as $comment)
           <tr>
            <th><input type="checkbox" class="checkbox"  name="" data-id="{{$comment->id}}"></th>
            <td>{{ $stt++ }}</td>
            <td>{{ $comment->title}}</td>
            <td>{{ $comment->content}}</td>
            <td>{{ $comment->member_rate}}</td>
            <td>{{ $comment->title}}</td>
            <td>
                @if($comment->status == 1)
                    <p style="color: blue"></p>{{'Chờ duyệt'}}
                @elseif($comment->status == 2)
                     <p style="color: green">{{'Đã duyệt'}}</p>
                @else
                     <p style="color:red"></p>{{'Xóa'}}
                @endif
            </td>
            <td>
                <a href="{{route('delete.comment',$comment->id)}}"><i class="fa fa-trash tacvu" style="color: red"></i></a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{$comments->links()}}</div>
  </div>

@endsection
@section('script-bottom')
<script type="text/javascript">
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
                      url: '{{route('delete-multiple-Comment-susscess')}}',
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


