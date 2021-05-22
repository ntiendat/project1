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
                    <div><input type="checkbox" name="ten" />Tên người đặt</div>
                    <div><input type="checkbox" name="Email" />Tổng tiền</div>
                    <div><input type="checkbox" name="diachi" />Thanh toán</div>
                    <div><input type="checkbox" name="sodienthoai" />Ghi chú</div>
                    <div><input type="checkbox" name="tgtao" />Thời gian tạo</div>
                    <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>

            </div>
        </div>
        <div class="form div-add" style="">
            {{-- <a href="{{route('list.process')}}" style="margin-bottom: 5px"> Danh sách đơn hàng đã được xử lý</a>
            --}}
            <p>Trạng thái</p>
            <select name="status-comment" class="form-control" id="status-comment">
                <option value="0">--</option>
                <option value="1">Chờ xử lý</option>
                <option value="2">Xác nhận đơn hàng</option>
                <option value="3">Đóng gói đơn hàng</option>
                <option value="4">Đơn hàng đang vận chuyển</option>
                <option value="5">Đơn hàng đã được giao</option>
                <option value="6">Hoàn trả đơn hàng</option>
            </select>
        </div>
    </div>
    <br>
    <table id="someTable" class="table table-striped table-hover table-primary"
        style="text-align: center;width: 100% !important;">
        <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
            <tr>
                <th><input type="checkbox" id="check_all" name=""></th>
                <th scope="col" class="">STT</th>
                <th scope="col"></th>
                <th scope="col" class="ten">Tên người đặt</th>
                <th scope="col" class="Email">Tổng tiền</th>
                <th scope="col" class="diachi">Thanh toán</th>
                <th scope="col" class="sodienthoai">Ghi chú</th>
                <th scope="col" class="tgtao">Thời gian tạo</th>
                <th scope="col" class="tgtao">Trạng thái</th>
                <th scope="col" class="tacvu">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 1; ?>
            @foreach($bills as $bill)
            <tr>
                <th><input type="checkbox" name=""></th>
                <td>{{ $stt++ }}</td>
                <td></td>
                <td><a href="{{route('detail.bill',$bill->id)}}">{{ $bill->firstname }} {{ $bill->lastname }}</a></td>
                <td>{{ number_format($bill->total)}} <sup>đ</sup></td>
                <td>{{ $bill->payment}}</td>
                <td>{{ $bill->note}}</td>
                <td>{{ Carbon\Carbon::parse($bill->updated_at)->format('h:i')}} |
                    {{ Carbon\Carbon::parse($bill->updated_at)->format('d-m-Y')}}</td>
                @if($bill->status == 1)
                <td>
                    <p style="color: blue">{{'Chờ xử lý'}}</p>
                </td>
                @elseif($bill->status == 2)
                <td>
                    <p style="color: purple">{{'Xác nhận đơn hàng'}}</p>
                </td>
                @elseif($bill->status == 3)
                <td>
                    <p style="color: yellow">{{'Đóng gói đơn hàng'}}</p>
                </td>
                @elseif($bill->status == 4)
                <td>
                    <p style="color: #ff9933">{{'Đơn hàng đang vận chuyển'}}</p>
                </td>
                @elseif($bill->status == 5)
                <td>
                    <p style="color: green">{{'Đơn hàng đã được giao'}}</p>
                </td>
                @elseif($bill->status == 6)
                <td>
                    <p style="color: red">{{'Hoàn trả đơn hàng'}}</p>
                </td>
                @endif
                <th scope="col">
                    <a href="{{route('delete.bill',$bill->id)}}"
                        onclick="return confirm('bạn có chắc muốn xóa đơn hàng này không ?')"><i
                            class="fa fa-trash tacvu" style="color: red"></i></a>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">{{$bills->links()}}</div>

</div>


@endsection