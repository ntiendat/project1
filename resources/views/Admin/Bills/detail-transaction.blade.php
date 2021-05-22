@extends('layouts.master')

@section('title') Chi tiết đơn hàng @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Chi tiết giao dịch</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">


      @if (isset($nl_result))
      <div class="container">
        <div class="row">
   
          <div class="col-md-12 col-12" style="">
            <h3>Thông tin khách hàng</h3>
              <div class="form-group">
                  <label style="margin-right: 10px">Họ Tên: </label><label for="">{{$nl_result->buyer_fullname}}</label>
                  {{-- <input class="form-control" name="lastname" id="lastname" placeholder="Vui lòng nhập..." value="" /> --}}
              </div>
              <div class="form-group">
                  <label style="margin-right: 10px">Phương Thức Thanh Toán: </label><label for="">{{$nl_result->payment_method}}</label>
                  {{-- <input class="form-control" name="address" id="address" placeholder="Vui lòng nhập..." value="{{$nl_result->address}},{{$nl_result->name_ward}},{{$nl_result->name_province}},{{$nl_result->name_city}}" /> --}}
              </div>
              <div class="form-group">
                  <label style="margin-right: 10px">Số điện thoại: </label><label for="">{{$nl_result->buyer_mobile}}</label>
                  {{-- <input class="form-control" name="phone" id="phone" placeholder="Vui lòng nhập..." value="{{$nl_result->phone}}" /> --}}
              </div>
              <div class="form-group">
                  <label style="margin-right: 10px">Email: </label><label for="">{{$nl_result->buyer_email}}</label>
                  {{-- <input class="form-control" name="email" id="email" placeholder="Vui lòng nhập..." value="{{$nl_result->email}}" /> --}}
              </div>
              <div class="form-group">
                  <label style="margin-right: 10px">Loại thẻ: </label><label for="">{{$nl_result->type_card}}</label>
                  {{-- <input class="form-control" name="email" id="email" placeholder="Vui lòng nhập..." value="{{$nl_result->email}}" /> --}}
                 
              </div>
             
          </div>  
          
        </div>
      </div>
      @else
          
<div class="container">
  <div class="row">

    <div class="col-md-12 col-12" style="text-align: center">
      <i style="color: #f37031;font-size: 120px;margin-top: 50px; " class="fas fa-times-circle"></i>
      <H2 style="margin: 40px; color:red " >{{$err}}</H2>
    </div>
  </div>
</div>
      @endif
    <br>
  </div>
@endsection
@section('script')
  <script>
        $('#update-bill').on('click',function(){
            var status = $("#status_bill").val();
            var id_bill = $("#id_bill").val();
            // alert(status);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('update.bill.detail') }}",
                data: {
                    status: status,
                    id_bill: id_bill,
                },
                success:function (data) {
                    console.log(data['data']);
                    alert('Trạng thái đã được cập nhật');
                },
                error: function(response) {
                    console.log(response);
               }
            })
            return false;
        })
    </script>
@endsection