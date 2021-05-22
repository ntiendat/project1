<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function save_customer(Request $request){
    	$data = $request ->all();
    	$customer = new Customer();
    	$customer ->firstname =$data['fullname'];
    	$customer ->phone =$data['phone'];
    	$customer ->email =$data['email'];
        $customer ->lastname =$data['diachi'];
        $customer ->address =$data['ghichu'];
    	$customer ->save();

    }
}
