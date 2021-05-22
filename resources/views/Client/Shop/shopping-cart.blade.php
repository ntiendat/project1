@extends('Client.Layouts.master')

@section('title-client')
    <title>  Giỏ hàng</title>
@endsection

@section('content-client')

 <!--Page Title-->
     <section>
        <div class="container">
            <div class="box-similar-product mt-4">
                <h3 class="mb-3">Giỏ hàng </h3> 
                <div class="row">
                  <div class="col-md-8">
                    <nav>
                      <ol class="breadcrumb" style="background-color: #f5f5f5">
                        <li class="breadcrumb-item">
                          <a href="{{route('home.index')}}">{{ trans('mess.Home') }}</a>
                        </li>
                     
                        <li class="breadcrumb-item active">
                          <a href=""> Giỏ hàng</a>
                        </li>
                      </ol>
                    </nav>
                  </div>
                </div>
            </div>
        </div>
        @if(Session::has('cart'))
        <div class="container">
            <div  class="row">
                <div class="column col-lg-8 col-md-12 col-sm-12">
                    <!--Cart Outer-->
                    <div class="cart-outer">
                            <div  class="table-outer">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th class="product-name">Ảnh</th>
                                            <th class="product-thumbnail">Sản phẩm</th>
                                            <th class="hiden_price product-price">Giá</th>
                                            <th class="hiden_price product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product_cart as $product)
                                            <tr class="cart-item" id="car_{{$product['item']['id']}}">
                                            <input type="hidden" value="{{$product['item']['id']}}" id="id_product">
                                            <td class="product-remove"> 
                                                <a href="{{route('delete.product.cart',$product['item']['id'])}}" class="remove-cart">
                                                    x
                                                </a>
                                            </td>    
                                            <td class="product-thumbnail" >
                                            
                                                <a href="{{route('home.list.product',$product['item']['id'])}}">
                                                    @if($product['item']['product_media_id'] != 0)
                                                        <img style="max-width: 100%;height: 100px;display: inline-block;vertical-align: middle" 
                                                        src="{{asset('Media/'.$product['item']->Media->url)}}" alt="">
                                                    @else
                                                        <img src="Media/noimage.png" alt="">
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="product-name">
                                               {{$product['item']['title']}}
                                               <div class="price_qty">
                                               {{ number_format($product['item']['price']) }}  x {{$product['qty']}}
                                               <div>
                                            </td>
                                            <td class="hiden_price product-price">
                                            <span class="hiden_price">
                                                @if($product['item']['promotion_price'] == 0)
                                                    <p>
                                                       {{ number_format($product['item']['price']) }}<sup>đ</sup> 
                                                    </p>
                                                    <input type="hidden" value="{{$product['item']['price']}}" id="product-qty-{{$product['item']['id']}}">
                                                @else 
                                                    {{ number_format($product['item']['promotion_price']) }}<sup>đ</sup>
                                                    <input type="hidden" value="{{$product['item']['promotion_price']}}" id="product-qty-{{$product['item']['id']}}">
                                                @endif
                                                
                                            </span>
                                            </td>

                                            <td class=" hiden_price product-quantity">
                                                <div class="item-quantity">
                                                    <input min="0" type="number" class="qty" id="qty-{{$product['item']['id']}}" 
                                                            name="qty" style="margin: 1px;"  value="{{$product['qty']}}">
                                                </div>
                                            </td>
                                        
                                            <td class="product-subtotal">
                                                <span class="amount" id="product-subtotal-{{$product['item']['id']}}">
                                                    @if($product['item']['promotion_price'] ==0)
                                                        <h4>
                                                            <?php $price = $product['item']['price']*$product['qty'];   ?>  
                                                        </h4>  
                                                    @else 
                                                    <h4>
                                                        <?php $price = $product['item']['promotion_price']*$product['qty'];  ?> 
                                                    </h4> 
                                                    @endif
                                                </span>
                                                <label id="total-qty-{{$product['item']['id']}}" style="display: inline-block;">{{number_format($price)}}</label><sup>đ</sup>
                                            </td>
                                        </tr>
                                        <input type="hidden" id="id-product-{{$product['item']['id']}}" value="{{$product['item']['id']}}">
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>

                    <div class="continue-shopping pull-left text-left">
                        <a class="btn btn-light btn-outline-warning" href="{{route('home.list.product',$product['item']['id'])}}">
                            ←&nbsp;Tiếp tục xem sản phẩm
                        </a>
                        <button type="submit" class="btn-outline-warning btn-outline-warning btn btn-warning " 
                            name="update_cart" value="Cập nhật giỏ hàng" disabled="" 
                            aria-disabled="true">Cập nhật giỏ hàng</button>
                    </div>
                </div>   
                
                <div class=" table column col-lg-4 col-md-12 col-sm-12">
                    <table  class="table cart-outer">
                        <tr>
                            <th class="conghang" scope="col">Cộng giỏ hàng</th>
                        </tr>
                        <tr>
                            <th>
                                Tổng tiền:
                                <span class="col total-price " id="totalPrice">{{number_format(Session('cart')->totalPrice)}}đ</span>

                            </th>
                           
                           

                        </tr>
                    </table>

                    <div class="form-group">
                        <a href="{{route('get.checkout')}}" class="thanhtoan theme-btn btn tienhanhthanhtoan">
                            Tiến hành thanh toán
                        </a>
                    </div>

                    <div class="form-group">
                        <a href="" class="thanhtoan btn btn-danger">
                            Phiếu ưu đãi
                        </a>
                    </div>

                    <div class="apply-coupon clearfix">
                        <div class="form-group">
                            <input type="text" name="thanhtoan coupon-code" id="magiam" class="thanhtoan input" placeholder="Mã ưu đãi">
                        </div>
                
                        <div class="form-group">
                            <button type="button" type="submit" id="apdung" class="thanhtoan apdung">Áp dụng</button>
                    </div>

                </div>
                
            </div>
        </div>
    </section>
    @endif
    <script>
        $(".apdung").click(function(){
          var coupon = $('#magiam').val();
      
        console.log(coupon)
          $.ajax({
              url:"{{route('shopping.checkcoupon')}}",
              method:"POST",
              data:{
                "_token": "{{ csrf_token() }}",
                coupon:coupon,
                
              },
  
              success:function(data)
              {
                  var obj = JSON.parse(data);
                    console.log(obj.priceAfterDiscount);
                    $('#totalPrice').text(obj.priceAfterDiscount);
                // location.reload();
              },
              error: function(response) {
                  
             }
  
          });


        });
      </script>
@endsection


    </section>
   
@section('script-client')
    
@endsection
    