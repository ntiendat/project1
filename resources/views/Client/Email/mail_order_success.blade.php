@extends('Client.Email.layout.index')
 @section('content_mail')
      <tr>
        <td align="center" valign="middle" style="background:#ffffff">
            <table style="width:580px" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <tr>
                        <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:24px;color:#065fd4;text-transform:uppercase;font-weight:bold;padding:25px 10px 15px 10px">
                            Thông báo đặt hàng thành công
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="middle" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding:0 10px 20px 10px;line-height:17px">
                            Chào <b>{{ $firstname }} {{ $lastname }}</b>,
                            <br> Cám ơn bạn đã mua sắm tại Setech
                            <br>
                            {{-- <br> Đơn hàng của bạn đang sẽ được gửi đến trong vòng 24h tới,<br> Thời hạn sử dụng: <b>7 ngày kể từ ngày giao hàng</b> và phải bảo quản trong găn tủ lạnh có nhiệt độ từ 0 - 8 độ C.
                            <br>Chúc bạn ăn bánh ngon miệng  --}}
                            {{-- <b>chờ shop</b>  
                            <b>xác nhận</b> (trong vòng 24h) --}}
                            {{-- <br> Chúng tôi sẽ thông tin <b>trạng thái đơn hàng</b> trong email tiếp theo. --}}
                            {{-- <br> Bạn vui lòng kiểm tra email thường xuyên nhé. --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="background:#ffffff">
            <table style="width:580px;border:1px solid #065fd4;border-top:3px solid #065fd4" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <tr>
                        <td colspan="2" align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666666;padding:10px 10px 20px 15px;line-height:17px"> 
                            <b>Đơn hàng của bạn #</b> 
                            <a href="#" style="color:#065fd4;font-weight:bold;text-decoration:none" target="_blank">0000{{ $id_bill }}
                            </a>
                            <span style="font-size:12px">({{ $created_at }})</span>
                        </td>
                    </tr>
                    @foreach($product_cart as $key => $value)
                        {{-- <?php dd($value['item']['title']); ?> --}}
                        <tr>
                            <td align="left" valign="top" style="width:120px;padding-left:15px">
                                <a href="#_" style="border:0"> 
                                    <img src="Media/{{$value['item']['product_media_id']}}" height="120" width="120" style="display:block;border:0px"> 
                                </a>
                            </td>
                            <td align="left" valign="top">
                                <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px"> 
                                                <b>Sản phẩm</b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                 <a href="#" style="color:#115fff;text-decoration:none" target="_blank">
                                                   {{$value['item']['title']}}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;padding-left:15px;padding-right:10px;line-height:20px;padding-bottom:5px"> 
                                                <b>Tên Shop</b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px"> 
                                                <a href="#" style="color:#115fff;text-decoration:none" target="_blank">
                                                    Setech
                                                </a>
                                                - 0967461697
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                                <b>Giá tiền: </b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                                                {{ number_format($value['unit_price']) }} <sup>đ</sup>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                                                <b>Người nhận</b>
                                            </td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                                            <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px"> 
                                                <b>{{ $firstname }} {{ $lastname }}</b> - {{ $phone }}
                                                <br>
                                                {{ $address }}-{{ $wards }}-{{ $province }}-{{ $city }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr>
                        <td align="left" valign="top" style="width:120px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:15px;padding-right:10px;padding-bottom:5px"> 
                            <b>Tổng tiền: </b>
                        </td>
                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-bottom:5px">:</td>
                        <td align="left" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#666666;line-height:20px;padding-left:10px;padding-bottom:5px">
                            <sup>đ</sup>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" valign="top" style="padding-top:20px;padding-bottom:20px;border-bottom:1px solid #ebebeb">
                            <a href="#" style="border:0px" target="_blank"> 
                              
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
 @endsection