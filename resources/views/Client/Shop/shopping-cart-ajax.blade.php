@extends('Client.Layouts.master')

@section('title-client') Shopping Cart  @endsection

@section('content-client')

 <!--Page Title-->
    <section class="page-title" style="background-image: url(HTML/Setech/images/background/12.jpg);">
        <div class="auto-container">
            <h1>Shopping Cart</h1>
            <span class="title_divider"></span>
            <ul class="page-breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li>Shopping Cart</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Cart Section-->
    <section class="cart-section">
        <div class="auto-container">
            <div class="row">
                <div class="column col-lg-9 col-md-12 col-sm-12">
                    <!--Cart Outer-->
                    <div class="cart-outer">
                        <div class="table-outer">
                            <table class="cart-table">
                                <thead class="cart-header">
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total = 0;
                                    $cart= Session::get('cart');
                                ?>

                                 <?php
                                    $Subtotal = $car['product_price'] * $car['product_qty'];
                                    $total+=$Subtotal;
                                 ?>
                                        <tr class="cart-item">
                                            <td class="product-remove">
                                             <a href="{{url('/cart/delete-product/'.$car['session_id'])}}">
                                                <span class="flaticon-multiply"></span>
                                            </a>
                                            </td>
                                            <td class="product-thumbnail"><a href="#"><img src="Media\{{$car['product_image']}}" alt="hinhf anh" style="width: 100px; height: 100px;"></a></td>
                                            <td class="product-name">{{$car['product_name']}}<a href="shop-single.html"></a></td>
                                            <td class="product-price">{{$car['product_price']}}</td> 
                                            <td class="product-quantity"><div class="item-quantity"> <input type="number" class="qty" name="qty" value="{{$car['product_qty']}}"> </div></td>
                                            <td class="product-subtotal"><span class="amount">
                                                
                                                 {{ $Subtotal }}

                                            </span></td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-options clearfix">
                            <div class="apply-coupon clearfix">
                                <div class="form-group">
                                    <input type="text" name="coupon-code" class="input" placeholder="Coupon Code">
                                </div>
                                <div class="form-group">
                                </div>
                                <div class="form-group pull-right">
                                    <button type="button" class="theme-btn btn-style-four">Cập nhập giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column col-lg-3 col-md-12 col-sm-12">
                    <ul class="totals-table">
                        <li><h3>Tổng giỏ hàng</h3></li>
                        <li>
                            <div class="shipping-info">
                                <span class="flat-rate">Đơn vị tiền: VNĐ</span>
                                <span class="change-address"><a href="#">Change address</a></span> -->
                            </div>  
                        </li>
                        
                        <li><span class="col">Tổng tiền</span><span class="col total-price">{{$total}}</span></li>
                        <li><button type="button" class="theme-btn btn-style-four"><a href="{{route('get.checkout')}}">Đi đến thanh toán</a></button></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End Cart Section-->

@endsection