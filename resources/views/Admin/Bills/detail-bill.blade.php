@extends('layouts.master')

@section('title') Chi tiết đơn hàng @endsection

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Chi tiết đơn hàng</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
    <div class="row">
      <div class="col-md-6 col-12" style="border-right: 1px solid">
        <table id="someTable"  class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
          <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
              <tr>
                <th scope="col"   class="">STT</th>
                <th scope="col"  class="ten">Tên sản phẩm</th>
                <th scope="col"  class="price">Giá </th>
                <th scope="col"  class="qty">Số lượng </th>
                <th scope="col"  class="unit_price">Tổng cộng</th>
              </tr>
          </thead>
          <tbody>
            <?php $stt = 1; ?>
            @foreach($detail_bills as $detail_bill)
                 <tr>
                  <td>{{ $stt++ }}</td>
                  <td><img src="{{asset('Media/'.$detail_bill->url)}}" alt="" width="50px" height="50px"> {{ $detail_bill->title }}</td>
                  <td><p style="color:red;font-weight: bold;margin:0">{{ number_format($detail_bill->price) }}<sup>đ</sup></p></td>
                  <td>{{ $detail_bill->quantity}}</td>
                  <td><p style="color:red;font-weight: bold;margin:0">{{ number_format($detail_bill->unit_price)}} <sup>đ</sup></p></td>
              </tr>
              @endforeach
          </tbody>
        </table>
        <h3>Tổng số lượng</h3>
        <hr>
        <table id="someTable"  class="table table-striped table-hover table-primary" style="width: 100% !important;">
          <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
              <tr>
                <th scope="col"  class="total">Tổng cộng: </th>
                <th scope="col"  class="price"><p style="color:red;font-weight: bold;margin:0">{{number_format($detail_bill->total)}} <sup>đ</sup></p></th>
              </tr>
          </thead>
        </table>
        <div class="row">
          <div class="col-md-3"><label for="" style="line-height: 3;">Trạng thái</label></div>
          <div class="col-md-9">
            <select name="status_bill" id="status_bill" class="form-control">
              @if($detail_bill->status ==1)
                <option value="1" selected="">Chờ xử lý</option>
                <option value="2" >Xác nhận đơn hàng</option>
                <option value="3" >Đóng gói đơn hàng</option>
                <option value="4" >Đơn hàng đang vận chuyển</option>
                <option value="5" >Đơn hàng đã được giao</option>
                <option value="6" >Hoàn trả đơn hàng</option>
              @elseif($detail_bill->status ==2)
                <option value="2" selected="">Xác nhận đơn hàng</option>
                {{-- <option value="1" >Chờ xử lý</option> --}}
                <option value="3" >Đóng gói đơn hàng</option>
                <option value="4" >Đơn hàng đang vận chuyển</option>
                <option value="5" >Đơn hàng đã được giao</option>
                <option value="6" >Hoàn trả đơn hàng</option>
              @elseif($detail_bill->status ==3)
                <option value="3" selected="">Đóng gói đơn hàng</option>
                {{-- <option value="1" >Chờ xử lý</option> --}}
                {{-- <option value="2" >Xác nhận đơn hàng</option> --}}
                <option value="4" >Đơn hàng đang vận chuyển</option>
                <option value="5" >Đơn hàng đã được giao</option>
                <option value="6" >Hoàn trả đơn hàng</option>
              @elseif($detail_bill->status ==4)
                <option value="4" selected="">Đơn hàng đang vận chuyển</option>
                {{-- <option value="1" >Chờ xử lý</option> --}}
                {{-- <option value="2" >Xác nhận đơn hàng</option> --}}
                {{-- <option value="3" >Đóng gói đơn hàng</option> --}}
                <option value="5" >Đơn hàng đã được giao</option>
                <option value="6" >Hoàn trả đơn hàng</option>
              @elseif($detail_bill->status ==5)
                <option value="5" selected="">Đơn hàng đã được giao</option>
                {{-- <option value="1" >Chờ xử lý</option> --}}
                {{-- <option value="2" >Xác nhận đơn hàng</option> --}}
                {{-- <option value="3" >Đóng gói đơn hàng</option> --}}
                {{-- <option value="4" >Đơn hàng đang vận chuyển</option> --}}
                {{-- <option value="6" >Hoàn trả đơn hàng</option> --}}
              @elseif($detail_bill->status ==6)
                <option value="6" selected="">Hoàn trả đơn hàng</option>
                {{-- <option value="1" >Chờ xử lý</option> --}}
                {{-- <option value="2" >Xác nhận đơn hàng</option> --}}
                {{-- <option value="3" >Đóng gói đơn hàng</option> --}}
                {{-- <option value="4" >Đơn hàng đang vận chuyển</option> --}}
                {{-- <option value="5" >Đơn hàng đã được giao</option> --}}
              @endif
            </select>
          </div>
        </div>
      </div>

     {{--  <option value="1" >Chờ xử lý</option>
      <option value="2" >Xác nhận đơn hàng</option>
      <option value="3" >Đóng gói đơn hàng</option>
      <option value="4" >Đơn hàng đang vận chuyển</option>
      <option value="5" >Đơn hàng đã được giao</option>
      <option value="6" >Hoàn trả đơn hàng</option>
 --}}
      <div class="col-md-6 col-12" style="">
        <h3>Thông tin khách hàng</h3>
          <div class="form-group">
              <label style="margin-right: 10px">Họ Tên: </label><label for="">{{$detail_bill->firstname}} {{$detail_bill->lastname}}</label>
              {{-- <input class="form-control" name="lastname" id="lastname" placeholder="Vui lòng nhập..." value="" /> --}}
              <span class="error-message" id="lastnameErr">{{ $errors->first('lastname') }}</span>
          </div>
          <div class="form-group">
              <label style="margin-right: 10px">Địa chỉ: </label><label for="">{{$detail_bill->address}},{{$detail_bill->name_ward}},{{$detail_bill->name_province}},{{$detail_bill->name_city}}</label>
              {{-- <input class="form-control" name="address" id="address" placeholder="Vui lòng nhập..." value="{{$detail_bill->address}},{{$detail_bill->name_ward}},{{$detail_bill->name_province}},{{$detail_bill->name_city}}" /> --}}
              <span class="error-message" id="addressErr">{{ $errors->first('address') }}</span>
          </div>
          <div class="form-group">
              <label style="margin-right: 10px">Số điện thoại: </label><label for="">{{$detail_bill->phone}}</label>
              {{-- <input class="form-control" name="phone" id="phone" placeholder="Vui lòng nhập..." value="{{$detail_bill->phone}}" /> --}}
              <span class="error-message" id="phoneErr">{{ $errors->first('phone') }}</span>
          </div>
          <div class="form-group">
              <label style="margin-right: 10px">Email: </label><label for="">{{$detail_bill->email}}</label>
              {{-- <input class="form-control" name="email" id="email" placeholder="Vui lòng nhập..." value="{{$detail_bill->email}}" /> --}}
              <span class="error-message" id="emailErr">{{ $errors->first('email') }}</span>
          </div>
          <div class="form-group">
              <label style="margin-right: 10px">Ngày đặt: </label><label for="">{{Carbon\Carbon::parse($detail_bill->updated_at)->format('h:i')}} | {{ Carbon\Carbon::parse($detail_bill->updated_at)->format('d-m-Y') }}</label>
              <span class="error-message" id="create_atErr">{{ $errors->first('create_at') }}</span>
          </div>
      </div>  
    </div><br>
    <div style="text-align: center;">
      <input type="button" value="Cập nhật" id="update-bill" class="btn btn-primary">
      <input type="button" value="Hủy" id="delete-bill" class="btn btn-primary">
      <input type="hidden" value="{{$detail_bill->id_bill}}" id="id_bill">
    </div>
    
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