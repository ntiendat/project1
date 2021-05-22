@extends('layouts.master')

@section('title') Quản lý Voucher @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách voucher</a></li>
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
            <input id="search_voucher" type="text" placeholder="Tìm kiếm...">
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
                  <div><input type="checkbox" name="code" />code</div>
                  <div><input type="checkbox" name="ten" />Tên</div>
                  <div><input type="checkbox" name="songuoidung" />số người sử dụng tối đa</div>
                   <div><input type="checkbox" name="loai" />loại</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
                
              </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('add')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
        </div>
    </div>
    <br>
     <table id="someTable"  class="table table-striped table-hover table-primary" >
            <thead >
            <tr>
                <th class="checkbox1"><input type="checkbox"  name="" id="check_all"></th>
                <th scope="col" class="stt">STT</th>
                <th scope="col" class="code">code </th>
                <th scope="col" class="ten">Tên </th>
                <th scope="col" class="songuoidung">số người sử dụng tối đa</th>
                <th scope="col" class="loai">loại</th>
                <th scope="col" class="tacvu">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt =1 ?>

            @foreach($vouchers as $voucher)
            <tr>
                <th class="checkbox1"><input type="checkbox"  class="checkbox"  name="" data-id="{{$voucher->id}}"></th>
                <th scope="col" class="stt">{{$stt++}}</th>
                <th scope="col">{{substr($voucher->code,0,25)}}</th>
                <th scope="col">{{substr($voucher->name,0,25)}}</th>
                <th scope="col">{{$voucher->max_uses_user}}</th>
                <th scope="col">
                	@if($voucher->type ==1)
                        {{'Giảm theo phần trăm'}}
                    @else
                        {{'Giảm theo giá tiền'}}
                    @endif

                </th>                
                <th scope="col" class="tacvu"><a href="{{route('edit.voucher',['id'=>$voucher->id])}}"><i class="fa fa-edit tacvu"></i></a><a href="{{route('delete.vuocher',['id'=>$voucher->id])}}"> <i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>
            @endforeach
            </tbody>
        </table>
         <div class="row">{{ $vouchers->appends(Request::all())->links() }}</div>

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
                                url: '{{route('delete_multiple_voucher')}}',
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
    <script type="text/javascript">
    	$('#search_voucher').on('keyup',function(){
    		var search_voucher = $(this).val();
    		 $.ajax({
                    type: 'get',
                    url: '{{ route('search_voucher') }}',
                    data: {
                        'search': search_voucher
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
    	})
    </script>
@endsection


