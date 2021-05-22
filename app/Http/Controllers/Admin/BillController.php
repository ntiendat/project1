<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bills;
use App\Models\Billdetails;
use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Wards;
use Auth;
use DB;
use Carbon\Carbon;
use Session;
use App\Library\NganLuong\NL_CheckOutV3;
class BillController extends Controller
{   
    public function __construct()
    {
        $citys = City::all();
        $provinces = Province::all();
        $wards = Wards::all();
    }
    public function getList(Request $request){
    	
    	$bills = Bills::join('customers','customers.id','=','bills.id_customer')
    				// ->where('status',1)
                    ->orderBy('status','asc')
                    ->orderBy('created_at','desc')
    				->select('bills.*','customers.lastname','customers.firstname')
    				->paginate(10);
    	// dd($bills);
    	return view('Admin.Bills.list-bill', compact('bills'));
    }
    public function getListProcess(Request $request){
    	$bills = Bills::join('customers','customers.id','=','bills.id_customer')
    				->select('bills.*','customers.lastname','customers.firstname')
    				->where('status',5)
                    ->paginate(10);
    	return view('Admin.Bills.list-bill-success',compact('bills'));
    }


    public function updateStatus(Request $request) {

        $bills = Bills::find($request->id);
        $bills ->status = $request->status;
        $bills ->updated_at = Carbon::now('+7:00');
        $bills ->save();
        // Session::flash('success','Trạng thái đã được cập nhập');

    }

    //Xác nhận
    public function getComfirm(Request $request,$id){
    	$bills = Bills::find($id);
    	$bills ->status = 2;
    	$bills ->updated_at = Carbon::now('+7:00');
    	$bills ->save();
    	return redirect(route('list.bill'))->with('success','Đơn hàng đã được xác nhận');
    }

    //Dóng gói
    public function getPack(Request $request,$id){
        $bills = Bills::find($id);
        $bills ->status = 3;
        $bills ->updated_at = Carbon::now('+7:00');
        $bills ->save();
        return redirect(route('list.bill'))->with('success','Đơn hàng đã được đóng gói');
    }

    //Chuyển hàng
    public function getShipping(Request $request,$id){
        $bills = Bills::find($id);
        $bills ->status = 4;
        $bills ->updated_at = Carbon::now('+7:00');
        $bills ->save();
        return redirect(route('list.bill'))->with('success','Đơn hàng đang được vận chuyển');
    }

    //Giao hàng xong
    public function getSuccess(Request $request,$id){
        $bills = Bills::find($id);
        $bills ->status = 5;
        $bills ->updated_at = Carbon::now('+7:00');
        $bills ->save();
        return redirect(route('list.bill'))->with('success','Đơn hàng đã được giao');
    }
    //Hoàn trả hàng
    public function getReturn(Request $request,$id){
        $bills = Bills::find($id);
        $bills ->status = 6;
        $bills ->updated_at = Carbon::now('+7:00');
        $bills ->save();
        return redirect(route('list.bill'))->with('success','Đơn hàng bị hoàn trả');
    }

    public function updateDetailBill(Request $request){
        $data = $request->all();
        $id = $request['id_bill'];
        $status = $request['status'];
        $bill = Bills::where('id',$id)->update(
            array(
            'status' => $status,
            'updated_at' =>Carbon::now('+7:00'),
            )
        );
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $bill;
        return response()->json($respon);
    }

    public function getDetailBill(Request $request,$id){
        $data['detail_bills'] = Billdetails::join('product','product.id','=','bill_details.id_product')
                                            ->join('bills','bills.id','=','bill_details.id_bill')
                                            ->join('customers','bills.id_customer','=','customers.id')
                                            ->join('city','city.matp','=','customers.city')
                                            ->join('province','province.maqh','=','customers.province')
                                            ->join('ward','ward.xaid','=','customers.wards')
                                            ->leftjoin('media','product.product_media_id','=','media.id')
                                            ->where('bill_details.id_bill',$id)
                                            ->select('bill_details.*','product.title','product.price','media.url','city.name','customers.*','province.name','ward.name','customers.lastname','customers.firstname','bills.total','bills.status')
                                           ->get();
        // dd($data['detail_bills']);
        $data['status'] = Billdetails::join('product','product.id','=','bill_details.id_product')
                                            ->join('bills','bills.id','=','bill_details.id_bill')
                                            ->where('bill_details.id',$id)
                                            ->select('bills.status')
                                            ->first();


        //dd($data['detail_bills']);

        return view('Admin.Bills.detail-bill',$data);
    }
    public function getTransaction($token)
    {
      $bill = Bills::where('token',$token)->limit(1);
      include(app_path() . '/Library/NganLuong/config.php');
      $nlcheckout= new NL_CheckOutV3(MERCHANT_ID,MERCHANT_PASS,RECEIVER,URL_API);
      $nl_result = $nlcheckout->GetTransactionDetail($token);
      
      if($nl_result){
        $nl_errorcode           = (string)$nl_result->error_code;
        $nl_transaction_status  = (string)$nl_result->transaction_status;
        if($nl_errorcode == '00') {
          if($nl_transaction_status == '00') {
            return view('Admin.Bills.detail-transaction',compact('nl_result'));
          }
        }else{
          $err = $nlcheckout->GetErrorMessage($nl_errorcode);
          return view('Admin.Bills.detail-transaction',compact('err'));
        }
      }
    }


    public function destroy(Request $request)
    {
        $bill = Bills::where('id',$request->id)->delete();
        return redirect()->back()->with('success','Đơn hàng đã được xóa. ');
    }

    public function getListBill(Request $request){
        $output ='';
        $contacts = DB::table('bills')->where('status','=',$request->status_id)        
                        ->orderBy('status', 'desc')
                        ->get();
    }

    public function getListBybills(Request $request)
    {
        if($request->status == 0){
            $bills = Bills::join('customers','customers.id','=','bills.id_customer')
                        ->orderBy('status','asc')
                        ->select('bills.*','customers.lastname','customers.firstname')
                        ->paginate(10);
        }else{  
            $output ='';
            $bills = Bills::join('customers','customers.id','=','bills.id_customer')
                        ->where('status','=',$request->status)
                        //->where('',1)
                        ->orderBy('status','asc')
                        ->select('bills.*','customers.lastname','customers.firstname')
                        ->paginate(10);
            if($bills){
                $stt = 1;
                foreach ($bills as $key => $bill) {
                    //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
                    $option1 = '';
                    $option2 = '';
                    $option3 = '';
                    $option4 = '';
                    $option5 = '';
                    $option6 = '';
                    switch ($bill->status) {
                      case 1:
                        # code...
                        $option1 = 'selected';
                        break;
                      case 2:
                        # code...
                        $option2 = 'selected';
                        break;
                      case 3:
                        # code...
                        $option3 = 'selected';
                        break;
                      case 4:
                        # code...
                        $option4 = 'selected';
                        break;
                      case 5:
                        # code...
                        $option5 = 'selected';
                        break;
                      case 6:
                        # code...
                        $option6 = 'selected';
                        break;
                      
                      default:
                        # code...
                        break;
                    }
                    if (isset($bill->token)){  
                      $payment2 = '<td><a href="'.route('detail.transaction',$bill->token).'">'. $bill->payment.'</a></td>  '; 
                     }
                    else{  
                       $payment2 = ' <td>'.$bill->payment.'</td>';
                  }
                    
                      
                 
                    
                    $output .= '<tr>
                      <th><input type="checkbox" class="checkbox" data-id='.$bill->id.' ></th>
                      <th>' . $stt++ . '</th>
                      <th><a href="'.route('detail.bill',['id'=>$bill->id]).'"> ' . $bill->firstname .  '  ' . $bill->lastname .  '</th>
                      <th><a href="'.route('detail.bill',['id'=>$bill->id]).'"> ' . $bill->bill_code .  '</th>
                      <th>' . $bill->total . '</th> 
                      ' .  $payment2 . '
                      <th>' .  $bill->note . '</th> 
                      <th>' . Carbon::parse($bill->updated_at)->format('h:i'). ' | '. Carbon::parse($bill->updated_at)->format('d-m-Y') . ' </th>
                      <th>
                        <select name="status-contact" class="form-control optionstatus" data-id='.$bill->id.'>
                          <option value="0">--</option>
                          <option value="1" '. $option1 .'>Tiếp nhận</option>
                          <option value="2" '. $option2 .'>xác nhận đơn hàng</option>
                          <option value="3" '. $option3 .'>đóng gói đơn hàng</option>
                          <option value="4"'.  $option4 .'>Đơn hàng đang vận chuyển</option>
                          <option value="5" '. $option5 .'>Đơn hàng đã được giao</option>
                          <option value="6" '. $option6 .'>Hoàn trả đơn hàng</option>
                        </select>
                      </th>
                      <th scope="col" class="tacvu">
                        <a onclick="deletebill(this,'.$bill->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
                    </tr>';
                }
                $data['data'] = $output;
                $data['paging'] = '<div class="row">'.$bills->render().'</div>';
                return response($data);
            }               
        }
    }

    public function searchBill(Request $request){
        $output = '';
        $status_bill = $request->status_bill;

        $search = $request->search;

        
            if($status_bill != 0 ){
                $bills = Bills::join('customers','customers.id','=','bills.id_customer')
                    ->where('status','=', $status_bill)
                    ->where(function($query) use ($search){
                          $query ->where('firstname', 'LIKE', '%' . $search . '%')
                          ->orWhere('lastname', 'LIKE', '%' . $search . '%')
                          ->orWhere('bill_code', 'LIKE', '%' . $search . '%')
                          ->orWhere('total', 'LIKE', '%' . $search . '%')
                          ->orWhere('payment', 'LIKE', '%' . $search . '%')
                          ->orWhere('note', 'LIKE', '%' . $search . '%')
                          ->orderBy('status', 'desc');
                        
                        })  
                    ->select('bills.*','customers.lastname','customers.firstname')->paginate(10);
                  // dd( $bills);
            }else{
                $bills = Bills::join('customers','customers.id','=','bills.id_customer')
                    ->where('firstname', 'LIKE', '%' . $search . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $search . '%')
                    ->orWhere('bill_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('total', 'LIKE', '%' . $search . '%')
                    ->orWhere('payment', 'LIKE', '%' . $search . '%')
                    ->orWhere('note', 'LIKE', '%' . $search . '%')
                    ->orderBy('status', 'desc')->select('bills.*','customers.lastname','customers.firstname')->paginate(10);
            }
        
        $stt = 1;
        foreach ($bills as $key => $bill) {
            //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
            $option1 = '';
            $option2 = '';
            $option3 = '';
            $option4 = '';
            $option5 = '';
            $option6 = '';
            switch ($bill->status) {
              case 1:
                # code...
                $option1 = 'selected';
                break;
              case 2:
                # code...
                $option2 = 'selected';
                break;
              case 3:
                # code...
                $option3 = 'selected';
                break;
              case 4:
                # code...
                $option4 = 'selected';
                break;
              case 5:
                # code...
                $option5 = 'selected';
                break;
              case 6:
                # code...
                $option6 = 'selected';
                break;
              
              default:
                # code...
                break;
            }
            if (isset($bill->token)){  
              $payment2 = '<td><a href="'.route('detail.transaction',$bill->token).'">'. $bill->payment.'</a></td>  '; 
             }
            else{  
               $payment2 = ' <td>'.$bill->payment.'</td>';
          }
            $output .= '<tr>
              <th><input type="checkbox" class="checkbox" data-id='.$bill->id.'></th>
              <th>' . $stt++ . '</th>
              <th><a href="'.route('detail.bill',['id'=>$bill->id]).'"> ' . $bill->firstname .  '  ' . $bill->lastname .  '</th>
              <th><a href="'.route('detail.bill',['id'=>$bill->id]).'"> ' . $bill->bill_code .  '</th>
              <th>' . $bill->total . '</th> 
              ' .  $payment2 . '
              <th>' .  $bill->note . '</th> 
              <th>' . Carbon::parse($bill->updated_at)->format('h:i'). ' | '. Carbon::parse($bill->updated_at)->format('d-m-Y') . ' </th>
              <th>
                <select name="status-contact" class="form-control optionstatus" data-id='.$bill->id.'>
                  <option value="0">--</option>
                  <option value="1" '. $option1 .'>Tiếp nhận</option>
                  <option value="2" '. $option2 .'>xác nhận đơn hàng</option>
                  <option value="3" '. $option3 .'>đóng gói đơn hàng</option>
                  <option value="4"'.  $option4 .'>Đơn hàng đang vận chuyển</option>
                  <option value="5" '. $option5 .'>Đơn hàng đã được giao</option>
                  <option value="6" '. $option6 .'>Hoàn trả đơn hàng</option>
                </select>
              </th>

              <th scope="col" class="tacvu">
                <a onclick="deletebill(this,'.$bill->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a>
                </th>
            </tr>';

          }

        $data['data'] = $output;
        $data['paganate'] = '<div class="row">'.$bills->render().'</div>';

        return response($data);
    }
    
    public function delete_mutiple_bill(Request $request){
        $ids = $request->ids;

        Bills::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"xoá sản phẩm thành công"]);
    }
}