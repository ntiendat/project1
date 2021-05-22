@extends('layouts.master')

@section('title') Quản lý người dùng @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách người dùng</a></li>
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
                  <div><input type="checkbox" name="ho" />Họ</div>
                  <div><input type="checkbox" name="ten" />Tên</div>
                  <div><input type="checkbox" name="email" />Email</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
                
              </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('create.user')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
        </div>
    </div>
    <br>
     <table id="someTable"  class="table table-striped table-hover table-primary" >
            <thead >
            <tr>
                <th class="checkbox1"><input type="checkbox"  name="" id="check_all"></th>
                <th scope="col" class="stt">STT</th>
                <th scope="col" class="ho">Họ </th>
                <th scope="col" class="ten">Tên </th>
                <th scope="col" class="email">Email</th>
                {{-- <th scope="col">Password</th> --}}
                <th scope="col" class="tacvu">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt =1 ?>
            @foreach($users as $user)
            <tr>
                <th class="checkbox1"><input type="checkbox"  class="checkbox"  name="" data-id="{{$user->id}}"></th>
                <th scope="col" class="stt">{{$stt++}}</th>
                <th scope="col">{{substr($user->firstname,0,25)}}</th>
                <th scope="col">{{substr($user->lastname,0,25)}}</th>
                <th scope="col">{{$user->email}}</th>
                {{-- <th scope="col">{{$user->password}}</th> --}}
                <th scope="col" class="tacvu"><a href="{{route('edit.user',['id'=>$user->id])}}"><i class="fa fa-edit tacvu"></i></a><a href="{{route('delete.user',['id'=>$user->id])}}" onclick="return confirm('bạn có chắc muốn xóa không ?')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{-- <div class="row">{{ $users->appends(Request::all())->links() }}</div> --}}

    </div>
@endsection
@section('script')
     <script type="text/javascript">
            $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.user') }}',
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
                        if(confirm("Bạn có chắc muốn xoá người dùng đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-user.user')}}',
                                type: 'GET',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: 'ids='+strIds,
                                success: function (data) {
                                    if (data['status']==false) {
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


