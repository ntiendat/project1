<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;
use DB;

class ContactController extends Controller
{
	public function index(){
    	return view('Client.Contact.contact');
	}

	public function saveContact(Request $request){
		$mailto = 'sonnguyen2903198@gmail.com';

		$data = [
			'name'  => $request->last_name .' '. $request->first_name,
            'phone'  => $request['phone'],
            'content' => $request['contact_message'],       	

		];

		DB::table('contact')->insert($data);
		Mail::send('Client.Email.email-contact',$data,function($message) use ($mailto) {
			// $message->from($email,'Người gửi');
			$message->to($mailto,'Người nhận');
			$message->subject('Thông tin khách hàng liên hệ');
		});
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
		se()->json($respon);
		
	}

	
}
