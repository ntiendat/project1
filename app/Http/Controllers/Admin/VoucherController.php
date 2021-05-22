<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Auth;
use Session;

class voucherController extends Controller
{
	public function index()
    {
        $vouchers = Voucher::orderBy('id','desc')->paginate(10);
        // $user=$user->paginate(10)
        return view('Admin.Voucher.index',compact('vouchers'));
    }

	public function add(){
		 return view('Admin/Voucher/add');
	}

    public function store(Request $request){
    	$this->validate(
    		$request,
    		[
    			'code' => 'required|max:7',
                'voucher' => 'required|max:255',
                'description' => 'required|max:255',
                'max_uses' => 'required|max:255',
                'discount_amount' => 'required|max:7',
                'type' => 'required|max:7',
                'date_start' => 'required',
                'date_end' => 'required',

    		],
    		[
                
    		]
    	);
    	 Voucher::create(
    		array(
            'code' =>$request['code'],
            'name'  => $request['voucher'],
            'description' =>$request['description'],
            'max_uses_user'  => $request['max_uses'],
            'discount_amount'  =>$request['discount_amount'],
            'type' => $request['type'],
            'starts_at' => $request['date_start'],
            'expires_at' =>$request['date_end'],
            )
    	);
    	 Session::flash('success', 'Thêm sản phẩm thành công'); 
    	 return redirect(route('index'));
    }

    public function edit($id)
    {
        $vouchers = Voucher::find($id);
        return view('Admin.Voucher.edit',compact('vouchers'));
    }

     public function update(Request $request, $id)
    {   
    	$this->validate(
    		$request,
    		[
    			'code' => 'required|max:7',
    			'voucher' => 'required|max:255',
    			'description' => 'required|max:255',
    			'max_uses' => 'required|max:255',
    			'discount_amount' => 'required|max:7',
    			'type' => 'required|max:7',
    			'date_start' => 'required',
    			'date_end' => 'required',

    		],
    		[

    		]
    	);
    	
    	 Voucher::where('id',$id)->update(
    		array(
    		'used_user' => Auth::id(),
            'code' =>$request['code'],
            'name'  => $request['voucher'],
            'description' =>$request['description'],
            'max_uses_user'  => $request['max_uses'],
            'discount_amount'  =>$request['discount_amount'],
            'type' => $request['type'],
            'starts_at' => $request['date_start'],
            'expires_at' =>$request['date_end'],
            )
    	);
        
        Session::flash('success', 'Thông tin người dùng đã được sửa'); 
        return redirect(route('index'));
    }

    public function delete(Request $request, $id){
    	$vouchers = Voucher::where('id',$id)->delete();
    	Session::flash('success', 'Thông tin người dùng đã được xoá'); 
        return redirect(route('index'));

    }

    public function delete_multiple_voucher(Request $request){
      $ids = $request->ids;
      Voucher::whereIn('id',explode(",",$ids))->delete();
      return response()->json(['status'=>false,'message'=>"xoá voucher thành công"]);  
    }

    public function searchVoucher(Request $request){
    	// dd($request->search);
    	$search_vouchers = Voucher::where('code','like', '%'.$request->search.'%')
    							 ->orwhere('name','like', '%'.$request->search.'%')
    							 ->orwhere('max_uses_user','like', '%'.$request->search.'%')
    							 ->get();
    	$output ='';
    	
          $stt = 1;
          foreach ($search_vouchers as $key => $search_voucher) {  
          	$type = $search_voucher->type == 1 ? "Giảm theo phần trăm" : "Giảm theo giá tiền";
            $output .= '<tr>
                <th class="checkbox1"><input type="checkbox"  class="checkbox"  name="" data-id="'.$search_voucher->id.'"></th>
                <th scope="col" class="stt">'.$stt++.'</th>
                <th scope="col">'.substr($search_voucher->code,0,25).'</th>
                <th scope="col">'.substr($search_voucher->name,0,25).'</th>
                <th scope="col">'.$search_voucher->max_uses_user.'</th>
                <th scope="col">'.$type.'</th>                
                <th scope="col" class="tacvu"><a href="'.route('edit.voucher',['id'=>$search_voucher->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.vuocher',['id'=>$search_voucher->id]).'"> <i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        
        return response($output);
    }
}
