@extends('layouts.master')

@section('title') Danh sách Đơn hàng đã được giao @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách đơn hàng đã được giao</a></li>
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
                  <div><input type="checkbox" name="bill" />Bill code</div>
                  <div><input type="checkbox" name="Email" />Tổng tiền</div>
                  <div><input type="checkbox" name="diachi" />Hình thức thanh toán</div>
                  <div><input type="checkbox" name="sodienthoai" />Ghi chú</div>
                  <div><input type="checkbox" name="trangthai" />Trạng thái</div>
                  <div><input type="checkbox" name="tgtao" />Thời gian tạo</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
            
            </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('list.bill')}}" style="margin-bottom: 5px"> Danh sách đơn hàng </a>  
        </div>
    </div>
    <br>
    <table id="someTable"  class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
        <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
            <tr>
                <th><input type="checkbox" id="check_all"  name=""></th>

               <th scope="col" class="">STT</th>
               <th scope="col"  class="ten">Tên Khách Hàng</th>
                <th scope="col"  class="bill"> Bill code</th>
                <th scope="col"  class="Email">Tổng tiền</th>
                <th scope="col"  class="diachi">Hình thức thanh toán</th>
                <th scope="col"  class="sodienthoai">Ghi chú</th>
                <!-- <th scope="col"  class="trangthai">Trạng thái</th> -->
                <th scope="col"  class="trangthai">Ngày giao</th>
                <th scope="col"  class="tacvu">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
           <?php $stt = 1; ?>
           @foreach($bills as $bill)
           <tr>
            <th><input type="checkbox"  name=""></th>
            <td>{{ $stt++ }}</td>
            <td><a href="{{route('detail.bill',$bill->id)}}">{{ $bill->firstname }} {{ $bill->lastname }}</a></td>
            <td><a href="{{route('detail.bill',$bill->id)}}">{{ $bill->bill_code }}</a></td>
            <td>{{ number_format($bill->total)}} <sup>đ</sup></td>
            @if (isset($bill->token))
            <td><a href="{{route('detail.transaction',$bill->token)}}">{{ $bill->payment}}</a></td>    
         @else
             <td>{{$bill->payment}}</td>
         @endif
            <td>{{ $bill->note}}</td>
            <!-- <td>{{ $bill->status}}</td> -->
            <td>{{ Carbon\Carbon::parse($bill->updated_at)->format('h:i')}} | {{ Carbon\Carbon::parse($bill->updated_at)->format('d-m-Y')}}</td>
            <th scope="col">
              
                <a href="{{route('delete.bill',$bill->id)}}" onclick="return confirm('bạn có chắc muốn xóa đơn hàng này không ?')"><i class="fa fa-trash tacvu" style="color: red"></i></a>
            </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">{{$bills->links()}}</div>
  </div>

@endsection