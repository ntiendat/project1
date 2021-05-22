@extends('Client.Layouts.master')

@section('title-client')
    <title> Thanh toán thàh công</title>
@endsection

@section('content-client')
    @if ($check==1)
    <div style="text-align: center ; padding-bottom: 50px" class="container">
        <i style="color: #f37031;font-size: 120px;margin-top: 50px; " class="fas fa-check-circle"></i>
            <H1 style=" color: #f37031; margin: 20px 20px; ">Thanh toán thành công</H1>
            <p>Cảm ơn bạn đã mua sắm tại Xiaomi Việt</p>
            <a href="{{route('home.index')}}"><button type="button" class="btn btn-success">Tiếp Tục Mua Hàng</button></a>
    </div>

    @elseif($check==0)

    <div style="text-align: center ; padding-bottom: 50px" class="container">
        <i style="color: #f37031;font-size: 120px;margin-top: 50px; " class="fas fa-ban"></i>
            <H1 style=" color: #f37031; margin: 20px 20px; ">Chưa có gì trong giỏ hàng</H1>
            {{-- <p>Cảm ơn bạn đã mua sắm tại Xiaomi Việt</p> --}}
            <a href="{{route('home.index')}}"><button type="button" class="btn btn-success">Tiếp Tục Mua Hàng</button></a>
    </div>
   

    @else
    <div style="text-align: center ; padding-bottom: 50px" class="container">
        <i style="color: #f37031;font-size: 120px;margin-top: 50px; " class="fas fa-ban"></i>
            <H1 style=" color: #f37031; margin: 20px 20px; ">Thanh toán không thành công</H1>
            <p>Cảm ơn bạn đã mua sắm tại Xiaomi Việt</p>
            <a href="{{route('home.index')}}"><button type="button" class="btn btn-success">Tiếp Tục Mua Hàng</button></a>
    </div>
    @endif
   
@endsection
