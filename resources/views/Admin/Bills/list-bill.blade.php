@extends('layouts.master')

@section('title') Danh sách đơn hàng @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách đơn hàng</a></li>
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
                    
                  <div><input type="checkbox" name="ten" />Tên Khách Hàng</div>
                  <div><input type="checkbox" name="bill" />Mã đơn</div>
                  <div><input type="checkbox" name="Email" />Tổng tiền</div>
                  <div><input type="checkbox" name="diachi" />Thanh toán</div>
                  <div><input type="checkbox" name="sodienthoai" />Ghi chú</div>
                  <div><input type="checkbox" name="tgtao" />Thời gian tạo</div>
                  <div><input type="checkbox" name="trangthai" />Trạng thái</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
            
            </div>
        </div>
        <div class="form div-add" style="">
              {{-- <a href="{{route('list.process')}}" style="margin-bottom: 5px"> Danh sách đơn hàng đã được xử lý</a>  --}}
              <span class="tatcatrangthai">Trạng thái</span>
              <select name="status-bill" class="form-control" id="status-bill">
                  <option value="0">--</option>
                  <option value="1">Tiếp nhận</option>
                  <option value="2">Xác nhận đơn hàng</option>
                  <option value="3">Đóng gói đơn hàng</option>
                  <option value="4">Đơn hàng đang vận chuyển</option>
                  <option value="5">Đơn hàng đã được giao</option>
                  <option value="6">Hoàn trả đơn hàng</option>
              </select>
        </div>
    </div>
    <br>
    <table id="someTable"  class="table table-striped table-hover table-primary" >
        <thead>
            <tr>
                <th class="checkbox1"><input type="checkbox" id="check_all"  name=""></th>
                <th scope="col" class="stt">STT</th>
                <th scope="col"  class="ten">Tên Khách Hàng</th>
                <th scope="col"  class="bill">Mã đơn</th>
                <th scope="col"  class="Email">Tổng tiền</th>
                <th scope="col"  class="diachi">Thanh toán</th>
                <th scope="col"  class="sodienthoai">Ghi chú</th>
                <th scope="col"  class="tgtao">Thời gian tạo</th>
                <th scope="col"  class="trangthai">Trạng thái</th>
                <th scope="col"  class="tacvu">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
          <?php $stt = 1; ?>
          @foreach($bills as $bill)
            <tr>
              <th class="checkbox1"><input type="checkbox" class="checkbox" data-id="{{$bill->id}}"  name=""></th>
              <td class="stt">{{ $stt++ }}</td>
              <td><a href="{{route('detail.bill',$bill->id)}}">{{ $bill->firstname }} {{ $bill->lastname }}</a></td>
              <td><a href="{{route('detail.bill',$bill->id)}}">{{ $bill->bill_code }}</a></td>
              <td>{{ number_format($bill->total)}} <sup>đ</sup></td>
              @if (isset($bill->token))
                 <td><a href="{{route('detail.transaction',$bill->token)}}">{{ $bill->payment}}</a></td>    
              @else
                  <td>{{$bill->payment}}</td>
              @endif
             
              <td>{{ $bill->note}}</td>
              <td>{{ Carbon\Carbon::parse($bill->updated_at)->format('h:i')}} | {{ Carbon\Carbon::parse($bill->updated_at)->format('d-m-Y')}}
              </td>

              <td>
                  <select  class="form-control optionstatus" data-id="{{$bill->id}}">
                      <option value="0">--</option>
                      <option value="1" {{ $bill->status == 1 ? 'selected' : '' }}>Tiếp nhận</option>
                      <option value="2" {{ $bill->status == 2 ? 'selected' : '' }}>Xác nhận đơn hàng</option>
                      <option value="3" {{ $bill->status == 3 ? 'selected' : '' }}>Đóng gói đơn hàng</option>
                      <option value="4" {{ $bill->status == 4 ? 'selected' : '' }}>Đơn hàng đang vận chuyển</option>
                      <option value="5" {{ $bill->status == 5 ? 'selected' : '' }}>Đơn hàng đã được giao</option>
                      <option value="6" {{ $bill->status == 6 ? 'selected' : '' }}>Hoàn trả đơn hàng</option>
                  </select>
              </td>
          
              <th scope="col" class="tacvu">
                <a class="delete" data-id='{{ $bill->id}}'><i class="fa fa-trash tacvu" style="color: red"></i></a>
              </th>
            </tr>
            @endforeach
        </tbody>
    </table>
   <div id="pagination" class="row">
      {{ $bills->appends(Request::all())->links() }}
    </div>

  </div>


@endsection
@section('script')

    
     <script type="text/javascript">

            function deletebill(e,id) {
              var tr= $(e).parents("tr");
              if(confirm("Bạn có chắc muốn xoá đơn hàng")){  
                    $.ajax({
                        url: '{{ route('delete.bill') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Đơn hàng đã được xoá",1);
                        },error: function (data) {
                            showMessage("Đơn hàng xoá bị lỗi",2);
                        }
                    });
                }
            }

            $('.delete').on('click',function(){
              var id=$(this).attr('data-id');
              var tr= $(this).parents("tr");
              if(confirm("Bạn có chắc muốn xoá đơn hàng")){  
                    $.ajax({
                        url: '{{ route('delete.bill') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Đơn hàng đã được xoá",1);
                        },error: function (data) {
                            showMessage("Đơn hàng xoá bị lỗi",2);
                        }
                    });
                }
            });

            //load lai ajax khi tim kiem trong trang thai
            function reloadAjax() {
                $(".optionstatus").on('change',function(){
                    var id = $(this).attr('data-id');
                    var status = $(this).val();
                    // alert($(this).val());
                    // alert(id);
                    saveStatus(id,status)

                });
            }

            //luu vao database
            function saveStatus(id,status) {
                $.ajax({
                    url: '{{route('bill.updatestatus')}}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id:id,status:status},
                    success: function (data) {
                       showMessage("Trạng thái đã được cập nhập",1);
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


            //xu ly tim kiem ajax luu vao database
            $("#status-bill").on('change',function(){
               var status = $("#status-bill option:selected" ).val();
               // alert(status);

                $.ajax({
                    url: '{{route('list.billlist')}}',
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'status':status},
                    success: function (data) {
                       console.log(data);
                       $('tbody').html(data.data);
                       $('#pagination').html(data.paging);
                       reloadAjax();
                    },
                    error: function (data) {
                        alert(data);
                    }

                });

            })


            $('#search').on('keyup',function(){
              // alert('aaa');
              $value = $(this).val();
              $status_bill = $('#status-bill').val();
              $.ajax({
                type: 'get',
                url: '{{route('search.bill')}}',
                data: {
                  'search': $value,
                  'status_bill': $status_bill,
                },
                success:function(data){
                  console.log(data);
                  $('tbody').html(data.data);
                  $('#pagination').html(data.paganate);
                  reloadAjax();
                }
              })
            });
            
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            //xoa cac phan trong checkbox
            $('#actions').on('change',function() {
              // alert('aaaaaaaaaaaa');
                if ($("#actions option:selected").val() == 1) {

                    $("#actions").val(0).change();  
                    var idsArr = [];  

                    $(".checkbox:checked").each(function() {  
                        idsArr.push($(this).attr('data-id'));
                    });  

                    if (idsArr.length <=0)  {  
                        alert("Vui lòng chọn trước khi xoá");  
                    } else {  
                        if(confirm("Bạn có chắc muốn xoá danh sách đơn hàng đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-bill.bill')}}',
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
                                    reloadAjax();

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
        //click vao 
        $(document).ready(function() {

            //click vao class pagination class a sinh ra khi phan trang
            $(document).on('click', '.pagination a', function(e){

                var search_text = $('#search').val();
                var status = $("#status-bill option:selected" ).val();
                
 
                if (status != 0) {
                  //xu li mot lenh truoc khi tiep tuc 1 lenh click moi
                  e.preventDefault();
                  //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                  var page = $(this).attr('href').split('page=')[1];

                  fetch_data(page);
                  
                } else {
                  // alert($value);
                  e.preventDefault();
                  //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                  var page = $(this).attr('href').split('page=')[1];
                  // alert(page);
                  fetch_data_search(search_text,page);
                }
                
            });


            //chuyen trang trong tim kiem khi tim kiem bang thanh trang thai
            function fetch_data(page)
            {     
                //alert(page);
                
                var status = $("#status-bill option:selected" ).val();

                $.ajax({
                    type: "GET",
                    url: 'billlist?page=' + page,
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
  
                  $.ajax({
                      type: "GET",
                      url: 'search/bill?page=' + page,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: {'search':search_text},
                      success: function (data) {
                        //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                         $('tbody').html(data.data);
                         $('#pagination').html(data.paganate);
                         reloadAjax();                         
                      }
                  });
              }
        });
    </script>
@endsection