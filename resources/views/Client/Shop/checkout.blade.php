@extends('Client.Layouts.master')

@section('title-client') Thanh toán @endsection

@section('content-client')

    <!--Page Title-->

    <!--End Page Title-->
    {{-- <?php dd(Session::get('cart')); ?> --}}
    <!--CheckOut Page-->
    <section class="checkout-page">


        <div class="container">
            <section class="page-title" style="background-image: url(Media/anhbanner.jpg);">
                <div class="auto-container">
                    <h1>Thanh toán</h1>
                    <span class="title_divider"></span>
                    <ol class="breadcrumb" style="background-color: #f5f5f5">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.index') }}"> {{ trans('mess.Home') }}</a>
                        </li>

                        <li class="breadcrumb-item active">
                            <a href="">Thanh toán</a>
                        </li>
                    </ol>

                </div>
            </section>
            <div class="auto-container">
                <div class="coupen-outer">
                    <div class="upper-box">
                        <div class="text"><span class="icon flaticon-preference"></span> Bạn có mã giảm giá chưa? <button
                                class="theme-btn btn-style-four btn btn-link">Click vào đây để nhận mã</button></div>

                    </div>

                    <div class="form-group">
                        <label>Nếu bạn có mã giảm giá,vui lòng áp dụng nó bên dưới.</label>
                        @if ($data->er_code == 0)
                            <input type="text" id="magiam" value="{{ $cart->coupon }}" name="coupen-code"
                                placeholder="Coupon Code" class="input">
                        @else
                            <input type="text" id="magiam" name="coupen-code" placeholder="Coupon Code" class="input">
                        @endif
                        <button class="theme-btn btn-style-four btn btn-light apdung">Áp dụng mã giảm giá</button>
                    </div>
                </div>

                <form method="post" action="{{ route('post.nganluong') }}" id="target" class="default-form">
                    @csrf

                    <div class="row">
                        <div class="col-md-7">
                            <hr>
                            <h3 class="title">Chi tiết đơn hàng</h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <!--Form Group-->
                                    <div class="form-group">
                                        <div class="field-label">Họ <sup>*</sup></div>
                                        <input type="text" name="firstname" class="firstname form-control" id="firstname"
                                            value="{{ old('firstname') }}" placeholder="">
                                        <span class="error-message"
                                            id="firstnameErr">{{ $errors->first('firstname') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--Form Group-->
                                    <div class="form-group">
                                        <div class="field-label">Tên <sup>*</sup></div>
                                        <input type="text" name="lastname" class="form-control lastname"
                                            value="{{ old('lastname') }}" placeholder="">
                                        <span class="error-message"
                                            id="lastnameErr">{{ $errors->first('lastname') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="field-label">Chọn thành phố <sup>*</sup></div>
                                        <select name="city" id="city" class="choose city form-control">
                                            <option value="">--chọn tỉnh, thành phố--</option>
                                            @foreach ($city as $key => $ci)
                                                <option value="{{ $ci->matp }}">{{ $ci->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message" id="cityErr">{{ $errors->first('city') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="field-label">Chọn quận huyện <sup>*</sup></div>
                                        <select name="province" id="province" class="province choose form-control">
                                            <option value="">--chọn quận huyện--</option>
                                        </select>
                                        <span class="error-message"
                                            id="provinceErr">{{ $errors->first('province') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="field-label">Chọn xã phường <sup>*</sup></div>
                                        <select name="wards" id="wards" class="wards form-control">
                                            <option value="">--chọn xã phường--</option>
                                        </select>
                                        <span class="error-message" id="wardsErr">{{ $errors->first('wards') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="field-label">Địa chỉ <sup>*</sup></div>
                                        <input type="text" name="address" class="address form-control"
                                            value="{{ old('address') }}" placeholder="Số nhà 117, Thôn Hạ, Cụm 3 ">
                                        <span class="error-message"
                                            id="addressErr">{{ $errors->first('address') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="field-label">Số điện thoại<sup>*</sup></div>
                                        <input type="text" name="phone" class="phone form-control"
                                            value="{{ old('phone') }}" placeholder="">
                                        <span class="error-message" id="phoneErr">{{ $errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="field-label">Địa chỉ email<sup>*</sup></div>
                                        <input type="text" name="email" class="email form-control"
                                            value="{{ old('email') }}" placeholder="">
                                        <span class="error-message" id="emailErr">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div>
                                            <h4>THÔNG TIN BỔ XUNG</h4>
                                        </div>
                                        <div class="field-label">Ghi chú đơn hàng</div>
                                        <textarea name="note" class="note form-control" id="note" rows="5" cols="15"
                                            value="{{ old('note') }}"
                                            placeholder="Ghi chú về đơn hàng,ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-5">
                            <div class="order-box">
                                <h3>Đơn hàng : <span style=" color :#ff5a00">{{ $random }}</span> </h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    @if (Session::has('cart'))
                                        <tbody>
                                            @foreach ($product_cart as $product)
                                                <tr class="cart-item">
                                                    <td class="product-name">{{ $product['item']['title'] }}
                                                        <span class="product-quantity">× {{ $product['qty'] }}</span>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">
                                                                @if ($product['item']['promotion_price'] == 0)
                                                                    <?php $price = $product['item']['price']
                                                                    * $product['qty']; ?>
                                                                @else
                                                                    <?php $price =
                                                                    $product['item']['promotion_price'] * $product['qty'];
                                                                    ?>
                                                                @endif
                                                                <label
                                                                    id="total-qty-{{ $product['item']['id'] }}">{{ $price }}</label><sup>đ</sup>
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Tổng số tiền</th>
                                                <td><span
                                                        class="amount">{{ Session('cart')->totalPrice }}<sup>đ</sup></span>
                                                </td>
                                            </tr>
                                            <tr id="discount" class="order-total-sale">

                                                @if ($data->er_code == 0)

                                                    <th>Tổng số tiền sau sale</th>
                                                    <td><span
                                                            class="amount">{{ $data->priceAfterDiscount }}<sup>đ</sup></span>
                                                    </td>

                                                @else

                                                @endif

                                            </tr>

                                        </tfoot>
                                    @endif
                                </table>
                                <!--Payment Options-->
                                <div class="payment-options">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment"
                                                class="payment" value="COD" checked="checked" data-order_button_text="">
                                            <label class="payment_method" for="payment_method_bacs">Thanh toán khi nhận hàng
                                            </label>
                                            <div class="payment_box payment_method_bacs" style="display: block;">
                                                Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền
                                                cho nhân viên giao hàng
                                            </div>
                                        </li>
                                        <li class="payment_method_cheque">
                                            {{-- <form action="{{ url('charge') }}" method="post"> --}}
                                            <input id="payment_method_cheque" type="radio" class="input-radio"
                                                name="payment" class="payment" value="ATM" data-order_button_text="">
                                            {{-- <input type="text" name="amount" /> --}}
                                            <label class="payment_method" for="payment_method_cheque">Chuyển khoản </label>
                                            <div class="payment_box payment_method_cheque" style="">
                                                Chuyển tiền đến tài khoản sau:
                                                <br>- Số tài khoản: 123 456 789
                                                <br>- Chủ TK: Hoàng Tuấn Thành
                                                <br>- Ngân hàng BIDV, Chi nhánh Hà Nội
                                                <br>- Nội dung Chuyển khoản : "Thanh toán hoá đơn {{ $random }}"
                                            </div>
                                        </li>
                                        @error('option_payment')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        @error('bankcode')
                                            <div class="alert alert-danger">Chưa Chọn Ngân Hàng</div>
                                        @enderror
                                        <li class="payment_method_bacs">
                                            <input id="payment_method_ol" type="radio" class="input-radio" name="payment"
                                                class="payment" value="NL">
                                            <label class="payment_method" for="payment_method_bacs">Thanh toán
                                                Online</label>
                                            <div class="" id="nganluong" style="display: none;">
                                                <ul class="list-content">
                                                    <li>
                                                        <label><input type="radio" value="ATM_ONLINE"
                                                                name="option_payment">Thanh toán online bằng thẻ ngân hàng
                                                            nội địa</label>
                                                        <div class="boxContent">
                                                            <p><i>
                                                                    <span
                                                                        style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu
                                                                        ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch
                                                                    vụ thanh toán trực tuyến tại ngân hàng trước khi thực
                                                                    hiện.</i></p>
                                                            <div class="form-group">

                                                                <select id="listATM" class="form-control" name="bankcode"
                                                                    id="">
                                                                    <option value="0">---Chọn Ngân Hàng---</option>
                                                                    <option value="BIDV">Ngân hàng TMCP Đầu tư và Phát triển
                                                                        Việt Nam (BIDV)</option>
                                                                    <option value="VCB">Ngân hàng TMCP Ngoại Thương Việt Nam
                                                                        (VCB)</option>
                                                                    <option value="DAB">Ngân hàng Đông Á (DAB)</option>
                                                                    <option value="TCB">Ngân hàng Kỹ Thương (TCB)</option>
                                                                    <option value="MB">Ngân hàng Quân Đội (MB)</option>
                                                                    <option value="VIB">Ngân hàng Quốc tế (VIB)</option>
                                                                    <option value="ICB">Ngân hàng Công Thương Việt Nam (ICB)
                                                                    </option>
                                                                    <option value="EXB">Ngân hàng Xuất Nhập Khẩu (EXB)
                                                                    </option>
                                                                    <option value="ACB">Ngân hàng Á Châu (ACB)</option>
                                                                    <option value="HDB">Ngân hàng Phát triển Nhà TPHCM (HDB)
                                                                    </option>
                                                                    <option value="MSB">Ngân hàng Hàng Hải (MSB)</option>
                                                                    <option value="NVB">Ngân hàng Nam Việt (NVB)</option>
                                                                    <option value="VAB">Ngân hàng Việt Á (VAB)</option>
                                                                    <option value="VPB">Ngân Hàng Việt Nam Thịnh Vượng (VPB)
                                                                    </option>
                                                                    <option value="SCB">Ngân hàng Sài Gòn Thương tín (SCB)
                                                                    </option>
                                                                    <option value="PGB">Ngân hàng Xăng dầu Petrolimex (PGB)
                                                                    </option>
                                                                    <option value="GPB">Ngân hàng TMCP Dầu khí Toàn Cầu
                                                                        (GPB)</option>
                                                                    <option value="AGB">Ngân hàng Nông nghiệp và Phát triển
                                                                        nông thôn (AGB)</option>
                                                                    <option value="SGB">Ngân hàng Sài Gòn Công Thương (SGB)
                                                                    </option>
                                                                    <option value="BAB">Ngân hàng Bắc Á (BAB)</option>
                                                                    <option value="TPB">Tiền phong bank (TPB)</option>
                                                                    <option value="NAB">Ngân hàng Nam Á (NAB)</option>
                                                                    <option value="SHB">Ngân hàng TMCP Sài Gòn - Hà Nội
                                                                        (SHB)</option>
                                                                    <option value="OJB">Ngân hàng TMCP Đại Dương (OceanBank)
                                                                        (OJB)</option>
                                                                </select>
                                                            </div>

                                                            {{-- <ul class="cardList clearfix">
                                                                <li class="bank-online-methods ">
                                                                    <label for="vcb_ck_on">
                                                                        <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                                                        <input type="radio" value="BIDV"  name="bankcode" >
                                                                    
                                                                </label></li>
                                                                <li class="bank-online-methods ">
                                                                    <label for="vcb_ck_on">
                                                                        <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                                                        <input type="radio" value="VCB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="vnbc_ck_on">
                                                                        <i class="DAB" title="Ngân hàng Đông Á"></i>
                                                                        <input type="radio" value="DAB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="tcb_ck_on">
                                                                        <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                                                        <input type="radio" value="TCB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_mb_ck_on">
                                                                        <i class="MB" title="Ngân hàng Quân Đội"></i>
                                                                        <input type="radio" value="MB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_vib_ck_on">
                                                                        <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                                                        <input type="radio" value="VIB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_vtb_ck_on">
                                                                        <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                                                        <input type="radio" value="ICB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_exb_ck_on">
                                                                        <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                                                        <input type="radio" value="EXB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_acb_ck_on">
                                                                        <i class="ACB" title="Ngân hàng Á Châu"></i>
                                                                        <input type="radio" value="ACB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_hdb_ck_on">
                                                                        <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                                                        <input type="radio" value="HDB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_msb_ck_on">
                                                                        <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                                                        <input type="radio" value="MSB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_nvb_ck_on">
                                                                        <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                                                        <input type="radio" value="NVB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_vab_ck_on">
                                                                        <i class="VAB" title="Ngân hàng Việt Á"></i>
                                                                        <input type="radio" value="VAB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_vpb_ck_on">
                                                                        <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                                                        <input type="radio" value="VPB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_scb_ck_on">
                                                                        <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                                                        <input type="radio" value="SCB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="bnt_atm_pgb_ck_on">
                                                                        <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                                                        <input type="radio" value="PGB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="bnt_atm_gpb_ck_on">
                                                                        <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                                                        <input type="radio" value="GPB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="bnt_atm_agb_ck_on">
                                                                        <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                                                        <input type="radio" value="AGB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                        
                                                                <li class="bank-online-methods ">
                                                                    <label for="bnt_atm_sgb_ck_on">
                                                                        <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                                                        <input type="radio" value="SGB"  name="bankcode" >
                                                                    
                                                                </label></li>	
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_bab_ck_on">
                                                                        <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                                                        <input type="radio" value="BAB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_bab_ck_on">
                                                                        <i class="TPB" title="Tền phong bank"></i>
                                                                        <input type="radio" value="TPB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_bab_ck_on">
                                                                        <i class="NAB" title="Ngân hàng Nam Á"></i>
                                                                        <input type="radio" value="NAB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_bab_ck_on">
                                                                        <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                                                        <input type="radio" value="SHB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                                                <li class="bank-online-methods ">
                                                                    <label for="sml_atm_bab_ck_on">
                                                                        <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                                                        <input type="radio" value="OJB"  name="bankcode" >
                                                                    
                                                                </label></li>
                                                                
                                        
                                        
                                        
                                                                
                                                            </ul> --}}

                                                        </div>
                                                    </li>
                                                    <li>
                                                        <label><input type="radio" value="VISA" name="option_payment"
                                                                selected="true">Thanh toán bằng thẻ Visa hoặc
                                                            MasterCard</label>
                                                        <div class="boxContent">
                                                            <p><span
                                                                    style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu
                                                                    ý</span>:Visa hoặc MasterCard.</p>
                                                            <ul class="cardList clearfix">
                                                                <li class="bank-online-methods ">
                                                                    <label for="vcb_ck_on">

                                                                        <input type="radio" value="VISA" name="bankcode"> :
                                                                        Visa

                                                                    </label>
                                                                </li>

                                                                <li class="bank-online-methods ">
                                                                    <label for="vnbc_ck_on">
                                                                        <input type="radio" value="MASTER" name="bankcode">
                                                                        : Master
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </li><br>
                                        <li class="payment_method_BK">
                                            {{-- <form action="{{ url('charge') }}" method="post"> --}}
                                            <input id="payment_method_BK" type="radio" class="input-radio" name="payment"
                                                class="payment" value="BK" data-order_button_text="">
                                            {{-- <input type="text" name="amount" /> --}}
                                            <label class="payment_method" for="payment_method_BK">Thanh toán Bảo Kim
                                            </label>

                                        </li>


                                    </ul>
                                    <input id="checkout"
                                        style="background-color: #ff3300!important; color:white;border: rgb(223, 223, 223) solid 1px;padding: 10px 20px;"
                                        type="submit" name="checkout-cart"
                                        class="theme-btn btn-style-four checkout-cart button alt" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <input style="border: none" type="text" name="bill_code" hidden value="{{ $random }}">
                </form>
            </div>
        </div>
    </section>
    <!--End CheckOut Page-->

    <script language="javascript">
        $(".apdung").click(function() {
            var coupon = $('#magiam').val();

            // console.log(coupon)
            $.ajax({
                url: "{{ route('shopping.checkcoupon') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    coupon: coupon,

                },

                success: function(data) {
                    var obj = JSON.parse(data);

                    console.log(obj.priceAfterDiscount);
                    // $('#totalPrice').text(obj.priceAfterDiscount);
                    var html = '<th>Tổng số tiền sau sale</th><td><span class="amount">' + obj
                        .priceAfterDiscount + '<sup>đ</sup></span></td> ';
                    if (obj.er_code == 0) {
                        $('#discount').empty();
                        $('#discount').append(html);
                        console.log(html);
                        var phantuchon = $(".amount");
                        // console.log(phantuchon);
                        phantuchon.text(obj.totalPrice);
                    } else {
                        alert('Mã giảm giá không tồn tại hoặc hết hạn sử dụng')
                        $('#discount').empty();
                    }
                    // location.reload();
                },
                error: function(response) {}
            });
        });
        $('#checkout').click(function(e) {
            e.preventDefault()
            var a = $('#magiam').val();

            if (a == '') {
                $("#target").submit();
                // console.log(a);
            } else {
                $.ajax({
                    url: "{{ route('shopping.checkcoupon') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        coupon: $('#magiam').val(),
                    },
                    success: function(data) {
                        var obj = JSON.parse(data);
                        // console.log(obj.priceAfterDiscount);
                        if (obj.er_code === 0) {
                            // return true;
                            console.log(obj.er_code);
                            $("#target").submit();
                        } else {
                            alert('Mã đã hết hạn sử dụng');
                            $.ajax({
                                url: "{{ route('resetCoupon') }}",
                                method: "get",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function(data) {
                                    var obj = JSON.parse(data);
                                    console.log(obj.totalPrice)
                                    var html =
                                        '<tr class="order-total-sale"><th>Tổng số tiền sau sale</th>  <td><span class="amount">' +
                                        '|||||||||||||||' +
                                        '<sup>đ</sup></span></td>  </tr>  ';
                                    $('.amount').text(obj.totalPrice);
                                    $('#discount').empty();
                                },

                            });
                            return false;
                        }
                    },
                    error: function(response) {}
                });
            }

        })

    </script>
@endsection
