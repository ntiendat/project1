@extends('layouts.master')

@section('title') Danh sách tag @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách thẻ tag</a></li>
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
                  <div><input type="checkbox" name="ten" />Tên</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
                
              </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('create.tag.post')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
        </div>
    </div>
    <br>
     <table id="someTable" class="table table-striped table-hover table-primary" >
            <thead >
                <tr>
                    <th class="checkbox1"><input type="checkbox"  name="" id="check_all"></th>
                    <th scope="col" class="stt">STT</th>
                    <th scope="col" class="ten">Tên</th>
                    <th scope="col" class="tacvu">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
               <?php $stt = 1; ?>
                   @foreach($tags as $tag)
                   <tr>
                    <th class="checkbox1"><input type="checkbox"  class="checkbox"  name="" data-id="{{$tag->id}}"></th>
                    <td class="stt">{{ $stt++ }}</td>
                    <td>{{ $tag->name}}</td>
                    <th scope="col" class="tacvu">
                        <a href="{{route('edit.tag.post',['id'=>$tag->id])}}"><i class="fa fa-edit tacvu"></i></a>
                        <a class="delete" data-id={{$tag->id}}><i class="fa fa-trash tacvu" style="color: red"></i></a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>



@endsection
@section('script')
    
     <script type="text/javascript">

            $('.delete').on('click',function(){
              var id=$(this).attr('data-id');
              var tr= $(this).parents("tr");
              if(confirm("Bạn có chắc muốn xoá thẻ bài viết")){  
                    $.ajax({
                        url: '{{ route('delete.tag.post') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("thẻ bài viết đã được xoá",1);
                        },error: function (data) {
                            showMessage("Thẻ bài viết xoá bị lỗi",2);
                        }
                    });
                }
            });

            $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.tag.post') }}',
                    data: {
                        'search': $value
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
                        if(confirm("Bạn có chắc muốn xoá các thẻ đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-tag-post')}}',
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


