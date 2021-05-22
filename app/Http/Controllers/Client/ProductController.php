<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryLink;
use App\Models\Subscriber;
use App\Models\Billdetails;
use App\Models\Tag;
use App\Models\Lang;
use App\Models\TagLink;
use App\Models\Bills;
use App\Models\Customer;
use Carbon\Carbon;
use Auth;
use DB;
use Mail;
use App\City;
use App\Province;
use App\Wards;
use App\Models\History;
use App\Helper\Helper;
use App\Models\Cart;
use Session;
use App\Library\NganLuong\NL_CheckOutV3;
use Illuminate\Support\Str;


use App\Http\Controllers\Client\BaoKimSDK\src\BaoKim;
use App\Http\Controllers\Client\BaoKimSDK\src\SessionBK;

  

class ProductController extends Controller
{
  public function resetCoupon (){
    $oldCart = Session::has('cart')?Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->coupon =null;
    Session::put('cart',$cart);
    return  json_encode($cart);
  }
  public function checkCup ($code){
   
    $now = date('Y-m-d');
    $oldCart = Session::has('cart')?Session::get('cart'):null;
    $cart = new Cart($oldCart);
     $voucher = DB::table('voucher')
     ->where('code',$code)
     ->where('starts_at','<=',$now)
     ->where('expires_at','>',$now)
     ->limit(1)->get();
     $status = ['er_code'=>1,
                'priceAfterDiscount'=> $cart->totalPrice
    ];
     $priceAfterDiscount= $cart->totalPrice;
     if(isset($voucher[0])){
             $cart->coupon=$voucher[0]->code;
             $status['er_code'] = 0;
            if($voucher[0]->max_uses_user-$voucher[0]->used_user>0){
                if($voucher[0]->type==1){
                  $priceAfterDiscount=  $cart->totalPrice - $voucher[0]->discount_amount;
                    $status['priceAfterDiscount'] =$priceAfterDiscount;
                }
                else{
                  $priceAfterDiscount=  $cart->totalPrice -( $cart->totalPrice /100* $voucher[0]->discount_amount);
                  $status['priceAfterDiscount'] =$priceAfterDiscount;
                }  
                $cart ->coupon  =  $voucher[0]->code;
                Session::put('cart',$cart);
                // dd(Session('cart'));
            }
           else{
            //  echo 'hết mã';
                $status['er_code'] = 2;
           }    
     }
     else {
     }
   return  json_encode($status);
    
    
  }
  public function checkCoupon (){
    
   return  $this->checkCup($_POST['coupon']) ;
  }
  public function cancelTransaction ($bill_code){
    // Session::forget('cart');
    
    // $bill = DB::table('bills')->where('bill_code', $bill_code)->limit(1) ->delete();
    // $this->getCheckout();
    return redirect(route('get.checkout'));
  }
  public function paymentSuccess(Request $request){
    include(app_path() . '/Library/NganLuong/config.php');
    $nlcheckout= new NL_CheckOutV3(MERCHANT_ID,MERCHANT_PASS,RECEIVER,URL_API);
    $nl_result = $nlcheckout->GetTransactionDetail($_GET['token']);

if($nl_result){
	$nl_errorcode           = (string)$nl_result->error_code;
	$nl_transaction_status  = (string)$nl_result->transaction_status;
	if($nl_errorcode == '00') {
		if($nl_transaction_status == '00') {
			//trạng thái thanh toán thành công
			// echo "<pre>";
			// 	print_r( $nl_result);
			// echo "</pre>";
      $bill = DB::table('bills')->where('token', $nl_result->token)->limit(1) ->update(['status'=>2]);
      // \dd($nl_result);
      Session::forget('cart');
			return view('Client.Shop.done-pay',['check'=>1]);
		}
	}else{
      Session::forget('cart');
			return view('Client.Shop.done-pay',['check'=>2]);

  	}
  }
    
  }
  public function paymentSuccessbk(Request $request){
    // dd($_GET['mrc_order_id']);
      $bill = DB::table('bills')->where('bill_code', $_GET['mrc_order_id'])->limit(1) ->update(['status'=>2]);
      Session::forget('cart');
			return redirect(route('get.donepay'));
	
}
  public function getCheckoutDonePay(Request $request){
   
			return view('Client.Shop.done-pay',['check'=>1]);
	
}
    
  
  public function postNganLuong (Request $request){
    $validated = $request->validate([
      'firstname' => 'required',
      'lastname' => 'required',
      'city' => 'required',
      'province' => 'required',
      'wards' => 'required',
      'address' => 'required',
      'phone' => 'required',
      'email' => 'required|email',
      'payment' => 'required',
   ]);           

    // $array_items=array();		
    if($_POST['payment']=='NL')	{
      $validated = $request->validate([
        'payment' => 'required',
        'option_payment' => 'required',
        'bankcode' => 'required|alpha|min:3|max:10',
     ]);
      include(app_path() . '/Library/NganLuong/config.php');
      $nlcheckout= new NL_CheckOutV3(MERCHANT_ID,MERCHANT_PASS,RECEIVER,URL_API);
      


      $oldCart = Session::has('cart')?Session::get('cart'):null;
      $cart  = new Cart($oldCart);
      $data = json_decode($this->checkCup($cart->coupon), false); 
      $total_amount=$data->priceAfterDiscount;




      
      $array_items[0]= array('item_name1' => 'Product name',
              'item_quantity1' => 1,
              'item_amount1' => $total_amount,
              'item_url1' => 'http://nganluong.vn/');
      $payment_method = $_POST['option_payment'];
      $bank_code = @$_POST['bankcode'];
      $order_code =$_POST['bill_code'];
      $payment_type ='';
      $discount_amount =0;
      $order_description='';
      $tax_amount=0;
      $fee_shipping=0;
      $return_url =route('get.paymentSuccess');
      $cancel_url =route('cancel.transaction',$order_code) ;
      $buyer_fullname =@$_POST['firstname'].' '.$_POST['lastname'];
      $buyer_email =$_POST['email'];
      $buyer_mobile =$_POST['phone'];
      $buyer_address ='';
      if($payment_method !='' && $buyer_email !="" && $buyer_mobile !="" && $buyer_fullname !="" && filter_var( $buyer_email, FILTER_VALIDATE_EMAIL )  ){
       if($payment_method =="VISA"){
         $nl_result= $nlcheckout->VisaCheckout($order_code,$total_amount,$payment_type,$order_description,$tax_amount,
                           $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile, 
                               $buyer_address,$array_items,$bank_code);
       }
       elseif($payment_method =="ATM_ONLINE" && $bank_code !='' ){
         $nl_result= $nlcheckout->BankCheckout($order_code,$total_amount,$bank_code,$payment_type,$order_description,$tax_amount,
                             $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile, 
                             $buyer_address,$array_items) ;
       }
       if ($nl_result->error_code =='00'){
         
      //  Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
       $check = $this->postCheckout($request,$nl_result->token);
          if($check==1){
          return  redirect((string)$nl_result->checkout_url) ;
          }
          else {
            return view('Client.Shop.done-pay',['check'=>$check]);
          }
       }
       else{
        return view('Client.Shop.done-pay',['check'=>0]);
       }
     }
     else{
      // return  redirect(route('post.checkout')) ;
			return view('Client.Shop.done-pay',['check'=>0]);
     }
    }
    
    elseif($_POST['payment']=='BK'){

      BaoKim::setKey('a18ff78e7a9e44f38de372e093d87ca1', '9623ac03057e433f95d86cf4f3bef5cc');
    // dd($_POST['payment']);

      
//create Session
try {
  $order_code =$_POST['bill_code'];
  $return_url =route('get.paymentSuccessbk');
  $cancel_url =route('cancel.transaction',$order_code) ;
      $buyer_email =$_POST['email'];
      $buyer_mobile =$_POST['phone'];
      $oldCart = Session::has('cart')?Session::get('cart'):null;
      $cart  = new Cart($oldCart);
      $data = json_decode($this->checkCup($cart->coupon), false); 
      $total_amount=$data->priceAfterDiscount;
    $infoBill= [[
     'name'=>'Bill',
     'quantity' => 1,
     'description' => 'Mô tả',
     'images'=>[],
     'amount' =>  $total_amount,
     'currency' => 'vnd',
    ], ];
    $session = SessionBK::create([
        'payment_method_types'    => [1, 2, 3],
        'mrc_order_id'   => $_POST['bill_code'],
        'line_items'  => $infoBill,
        'success_url' =>  $return_url,
        'cancel_url' =>  $cancel_url,
        'webhook_url' =>  'https://example.com/webhook',
        'customer_email' =>   $buyer_email,
        'customer_phone' =>   $buyer_mobile,
          ]
          
      );
      $check = $this->postCheckout($request,null);
      if($check==1){
        header('Location: ' . $session->payment_url);
        exit();
      // return view('Client.Shop.done-pay',['check'=>$check]);
      }
      else {
        return view('Client.Shop.done-pay',['check'=>$check]);
      }
   
} 
catch(BaoKimSDK\Exceptions\BaoKimException $e) {
    error_log($e->getMessage());
}

      
      
    }
    else{
      $check = $this->postCheckout($request,null);
        if($check==1){
          Session::forget('cart');
        return view('Client.Shop.done-pay',['check'=>$check]);
        }
        else {
          return view('Client.Shop.done-pay',['check'=>$check]);
        }

    }
  }




  
  public function filter (Request $request) {
    if($request->filter==1){
      $data = Product::get(); // tăng dần
    }
    if($request->filter==2){
      $data = Product::orderBy('price', 'asc')->get(); // tăng dần
    }
    elseif($request->filter==3){
    $data = Product::orderBy('price', 'DESC')->get(); // giảm dần
    }
    elseif($request->filter==4){
    $data = Product::orderBy('created_at', 'asc')->get(); // giảm dần
    }
    elseif($request->filter==5){
      $data = Product::orderBy('count','desc')->get();
    }    
      return view('Client.layouts.list_products',compact('data'));;
  }
  
  public function getProducts () {

    
      $data = Product::get();
      return view('Client.Shop.list_products',compact('data'));
  }
  public function getProductsByTag (Request $request) {
    $tag = Tag::where('id',$_GET['id'])->limit(1)->get();
      $data = Product::join('product_tag','product.id','=','product_tag.product_id')->where('product_tag.tag_id',$_GET['id'])->get();
      return view('Client.Shop.product-by-tag',compact(['data','tag']));
  }
  

	public function getDetailProduct(Request $request, $id){
    // Session::forget('cart');

    $data['menuu2'] = Category::where('type',2) ->where('parent_id',0)->orWhere('parent_id',$id)-> get();

    $idd = Menu::where('link_id',$id)->first();
		// dd($idd);
    if(isset($idd->parent_id)){
      $data['id']=$idd->parent_id;
      $data['menuu'] = Menu::where('id',$idd->id) -> orWhere('parent_id',$idd->id)-> orWhere('parent_id',$idd->parent_id) ->get() ;
      // dd($idd);
    }else{

      $data['id']=-1;
      $data['menuu'] = Menu::where('parent_id',-1) ->get() ;
    }


    // dd($data['menuu']);
		$data['product'] = Product::find($id);
// dd($id);
		$data['product_image'] = Product::find($id) 
                ->join('product_media','product.id','=','product_media.product_id')
								->join('media','media.id','=','product_media.media_id')
								->where('product.id','=',$id)
								->select('media.url')
								->get();

		$data['product_image1'] =Product::find($id)
                ->join('product_media','product.id','=','product_media.product_id')
                ->join('media','media.id','=','product_media.media_id')
								->where('product.id','=',$id)
								->select('media.url',)
								->get();


    $data['product_image_av'] =Product::find($id)
                ->join('media','media.id','=','product.product_media_id')
                ->where('product.id','=',$id)
                ->first('media.url');

    $data['product_image_id1'] =Product::find($id)
                ->join('media','media.id','=','product.product_media_id')
                ->where('product.id','=',$id)
                ->first('media.url');

		$data['product_category'] = Product::join('category_link','product.id','=','category_link.link_id')
								->join('category','category_link.category_id','=','category.id')
								->where('category_link.type','=',2)
								->where('product.id',$id)
								->select('category.name','category_link.*')
								->get();
                // dd($data['product_category']);
		$data['menu'] =Menu::find($id);
    if(isset($data['product_category'][0])){
		$data['related'] = Product::join('category_link','product.id','=','category_link.link_id')
                      ->where('category_link.category_id','=',$data['product_category'][0]->category_id)
                      ->where('product.id','<>',$id)
                      ->select('product.*')
                      ->distinct()->limit(20)->get();

   
    }
		//đánh giá sao
    $data['rating'] =Comment::where('link_id',$id)->where('status',2)
    ->avg('member_rate'); // lấy trung bình sao
    $data['rating']  = round($data['rating']); //round(): làm tròn giá trị
    //nguoi dung danh gia
    $data['user_comment'] = Comment::where('link_id',$id)->where('status',2)->get();

    //get post 
    $data['detail'] = Post::limit(4)->get();

    //get log page
    $api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');

    $history_array = json_decode($api_history, true); //json_decode: chuyen doi chuoi json sang array
  
    $data['history'] = new History();
    $data['history']->link_id = $request->id;
    $data['history']->type = 2;
    $data['history']->location =$history_array['city'].','.$history_array['country'];
    $data['history']->ip = $history_array['ip'];
    $data['history']->save();

    //Đếm sản phẩm
    $data['product-count'] = Product::find($id);
    $data['product-count']->count += 1;
    $data['product-count']->save();
    
		return view('Client.Shop.detail-shop',$data);

	}
	public function getListProduct(Request $request,$id){
    // Session::forget('cart');
    $idd = Menu::where('link_id',$id)->first();
    $lang_id= Lang::where('lang',config('app.locale'))->first();
		// dd($idd);
    if(isset($idd->parent_id)){
      $data['pid']=$idd->parent_id;
      $data['menuu'] = Menu::where('id',$idd->id) -> orWhere('parent_id',$idd->id)-> orWhere('parent_id',$idd->parent_id) ->get() ;
      // dd($idd);
    }else{

      $data['pid']=-1;
      $data['menuu'] = Menu::where('parent_id',-1) ->get() ;
    }
    // dd(isset($_GET['min']));
    // $data['menuu2'] = Category::where('type',2) ->where('parent_id',0)->get();

    if(isset($_GET['min'])){
    //  dd($_GET['min']);
      $data['list_product_with_category'] = Product::join('category_link','product.id','=','category_link.link_id')
          ->leftJoin('media','media.id','=','product.product_media_id')
					->where('category_link.category_id',$id)
          ->where('product.promotion_price','>=',$_GET['min'])
          ->where('product.promotion_price','<=',$_GET['max'])
          ->where('lang_id',$lang_id->id)
          ->select('product.*')
					->get();
          // dd($data);
    }
    else{
      $data['list_product_with_category'] = Product::join('category_link','product.id','=','category_link.link_id')
      ->leftJoin('media','media.id','=','product.product_media_id')
      ->where('category_link.category_id',$id)->where('lang_id',$lang_id->id)
      // ->where('product.promotion_price','=',0)
      ->select('product.*')
      ->get();
    }
  
    
    $category = DB::table('category')->get();
          // dd($data);
    $cate = Category::find($id);
		$data['count_product'] = Product::join('category_link','product.id','=','category_link.link_id')
					->where('category_link.category_id',$id)
					->count();
		$data['post_recent'] = Post::orderBy('id','desc')->limit(3)->get();
    $api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');
    $history_array = json_decode($api_history, true); //json_decode: chuyen doi chuoi json sang array
  
    $data['history'] = new History();
    $data['history']->link_id = $request->id;
    $data['history']->type = 4;
    $data['history']->location =$history_array['city'].','.$history_array['country'];
    $data['history']->ip = $history_array['ip'];
    $data['history']->save();
		return view('Client.Shop.shop',\compact(['data','cate','category']));
	}


	//đánh giá sao
	public function postInserRating(Request $req){
		$this->validate($req,
          [
            'lastname'=>'required|max:255',
            'firstname'=>'required|max:255',
          ],
          [
           'lastname.required'=>'Không được trống !!!',
           'lastname.max'=>'Nhập tối đa 255 kí tự !!!',
           'firstname.required'=>'Không được trống !!!',
           'firstname.max'=>'Nhập tối đa 255 kí tự !!!',
          ]);

        $data = $req->all();
         $rating = DB::table('comment')->insertGetId(
            array(
            	'link_id' => $req->product_id,
            	'status'=>1,
            	'member_rate' => $req['index'],
              'type' => 2,
            	'content' => $req['message'],
            	'lastname' => $req['lastname'],
            	'firstname' => $req['firstname'],
            	'email' => $req['email'],
            	'created_at' => Carbon::now('+7:00'),
            )
        );

        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['rating'] = $rating;
        return response()->json($respon);
  }

	public function getCheckout(){


    $oldCart = Session::has('cart')?Session::get('cart'):null;
    $cart  = new Cart($oldCart);
    
    $data = json_decode($this->checkCup($cart->coupon), false); 
    
    
    // dd($cart);
     // Session::forget('cart');
		$city = City::orderby('matp','ASC')->get();
    $province = Province::orderby('maqh','ASC')->get();
    $wards = Wards::orderby('xaid','ASC')->get();
    //dd($city);
    $random = strtoupper(Str::random(10));

    while(true){
     
      $exits = Bills::where('bill_code', '=', $random)->first();
        if ($exits === null) {
          break;
        }
        else{
          // $random = uniqid('ABC',true);
          $random = strtoupper(Str::random(10));
        }
    }

    
    
		return view('Client.Shop.checkout',compact('city','province','wards','random','data','cart'));

	}

  public function select_delivery(Request $request){
    $data = $request->all();
    if($data['action']){
      $output = '';
      if($data['action']=="city"){

        $select_provice = Province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
          foreach ($select_provice as $key => $province)
            {
              $output.='<option value="'.$province->maqh.'">'.$province->name.'</option>';
            }
      }else{

        $select_wards = Wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
          foreach ($select_wards as $key => $wards) 
            {
              $output.='<option value="'.$wards->xaid.'">'.$wards->name.'</option>';
            }
      }
    
      echo $output;
    }
  }
  public function shoppingCart(Request $request)
  {
   
    // Session::forget('cart');
    return view('Client.Shop.shopping-cart');
    
  }
  public function addToCart(Request $request)
  {
    $data = $request->all();
    $id = $data['id'];
    $product = Product::find($id);
    
    if($product != null){
      $oldCart = Session('cart')?Session::get('cart') : null; //kieemr tra - dung toan tu? 3 ngoi.
      $cart = new Cart($oldCart);
      $cart->add($product,$id);//phuong thuc add trong Cart.php truyen vao 2 tham so la` items va id
      $request->session()->put('cart',$cart); //gan gio? hang vao session cart bang phuowng thuc put
    }

    $product->slug = asset('Media/'.$product->Media->url) ;

    $respon['message'] = "success";
    $respon['status'] = true;
    $respon['data'] = $product;

    return response()->json($respon); 

  }
  public function addToCartDetail(Request $request)
  {
    $data = $request->all();
    $id = $data['id'];
    $quantity = $request->qty;
    // dd($quantity)
    $product = Product::find($id);
    // dd($product);
      if($product != null){
        $oldCart = Session('cart')?Session::get('cart') : null; //kieemr tra - dung toan tu? 3 ngoi.
        $cart = new Cart($oldCart);
        $cart->add_detail($product,$id,$quantity);//phuong thuc add trong Cart.php truyen vao 2 tham so la` items va id
        $request->session()->put('cart',$cart); //gan gio? hang vao session cart bang phuowng thuc put
      }
      // return redirect()->back();
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon); 

  }
  
  public function updateToCart(Request $request)
  {
    // Session::forget('cart');
    $id = $request->product_id;
    $quantity = $request->qty;
    $oldCart = Session('cart')?Session::get('cart') : null; 
    
    if ($oldCart != null) {
      $cart = new Cart($oldCart);
      $cart->updateItem($oldCart,$id,$quantity);
      Session::put('cart',$cart);
    }
    
    $respon['data'] = $cart;
    $respon['message'] = "success";
    $respon['status'] = true;

    return response()->json($respon);
  }

  public function deleteCart($id){
    $oldCart = Session::has('cart')?Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);
    if(count($cart->items)>0){
      Session::put('cart',$cart);
    }
    else{
      Session::forget('cart');
    }
    return redirect()->back();
  }
  //checkout
  public function postCheckout($request, $token){


    if(Session::has('cart')){
     
      $cart = Session::get('cart');
      $oldCart = Session::has('cart')?Session::get('cart'):null;
      $cart2  = new Cart($oldCart);
      $data = json_decode($this->checkCup($cart2->coupon), false); 
      $total_amount=$data->priceAfterDiscount;
      $cart->totalPrice= $total_amount;
      $data = $request ->all();
      
      $data_customer = [
        'firstname' => $data['firstname'],
        'lastname' => $data['lastname'],
        'city' => $data['city'],
        'province' => $data['province'],
        'wards' => $data['wards'],
        'address' => $data['address'],
        'phone' => $data['phone'],
        'email' => $data['email'],
        'created_at' => Carbon::now('+7:00'),
        'updated_at' => Carbon::now('+7:00'),
      ];
      DB::beginTransaction();
      try {
        $sl = DB::table('voucher')->where('code',$cart2->coupon)->limit(1)->get();
       
        if(isset($sl[0])){
          $sl= $sl[0]->used_user+1;
        // dd($sl);

           DB::table('voucher')->where('code',$cart2->coupon)
           ->update(array('used_user' => $sl));
        // DB::table('users');
        // dd($aaaa);
        }
        
        DB::commit();
      } catch (Exception $e) {
          DB::rollBack();
          throw new Exception($e->getMessage());
      }
      DB::beginTransaction();
        try {
          $id_customer = DB::table('customers')->insertGetId($data_customer);
          DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
      $data_bill = [
        'id_customer' => $id_customer,
        'created_at' => Carbon::now('+7:00'),
        'total' => $cart->totalPrice,
        'payment' => $data['payment'],
        'token'=> $token,
        'bill_code'=> $data['bill_code'],
        'note' => $data['note'],
        'status' => 1,
        'updated_at' => Carbon::now('+7:00'),
      ];

      
      DB::beginTransaction();
        try {
          $id_bill = DB::table('bills')->insertGetId($data_bill);
          DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
      // if(Session::get('fee') && Session::get('coupon')){
      //   $bill->total = $cart->totalPrice + Session::get('fee') - Session::get('coupon')['discount_amount'];
      // }
      // elseif(Session::get('fee') && !Session::get('coupon')){
      //   $bill->total = $cart->totalPrice + Session::get('fee');
      // }
      // elseif(Session::get('coupon') && !Session::get('fee')){
      //   $bill->total = $cart->totalPrice - Session::get('coupon')['discount_amount'];
      // }
      // $bill->fee_ship =Session::get('fee');


      foreach ($cart->items as $key => $value) {
        $data_billDetail = [
          'id_bill' => $id_bill,
          'id_product' => $key,
          'quantity' => $value['qty'],
          'unit_price' => ($value['unit_price']/$value['qty']),
        ];

       
        DB::beginTransaction();
        try {
          $id_billDetail = DB::table('bill_details')->insertGetId($data_billDetail);
          DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        //sp đã bán 
        // dd($data_billDetail);
      }
      $email = $data['email'];
        Mail::send('Client.Email.mail_order_success',[
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'city' => $data['city'],
          'province' => $data['province'],
          'wards' => $data['wards'],
          'address' => $data['address'],
          'phone' => $data['phone'],
          'email' => $data['email'],
          // 'created_at' => Carbon::now('+7:00'),
          'id_customer' => $id_customer,
          'created_at' => Carbon::now('+7:00'),
          
          'total' => $cart->totalPrice,
          'payment' => $data['payment'],
          'note' => $data['note'],
          'status' => 1,
          'id_bill' => $data['bill_code'],
          'id_product' => $key,
          'quantity' => $value['qty'],
          'unit_price' => $value['unit_price'],
           'cart' =>$cart,
        ],function($message) use ($email){
          $message->to( $email ,'Người nhận');
          $message->subject('Thông tin đơn hàng !!!');
        });
        return 1;

    }else{
      return 0;
    }
  }

  public function searchProduct(Request $request){
        $data = Product::where('product.title', 'LIKE', '%' . $request->name_search . '%')
                        ->leftJoin('media','product.product_media_id', '=', 'media.id')
                        ->select('product.*','media.url')
                        ->get();
        return view('Client.Shop.list_products',compact('data'));
  }
}