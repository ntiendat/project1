<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
// use Validate;
use DB;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ResetpasswordController extends Controller
{
   public function index()
    {
        $id = Auth::id();
        $data['user'] = User::find($id);

        return view('Admin.User.newpass',$data);
    }

    public function update(Request $request){
    	
     	$user = User::findOrFail($id = Auth::id());

		if (Hash::check($request->password, $user->password)) { 
            $user->fill([
                'password' => bcrypt($request->passwordreset)
                ])->save();
		    Session::flash('success', 'Password changed');
		    return redirect()->back();

		} else {
		    Session::flash('danger', 'Mật khẩu cũ không đúng');
		    return redirect()->back();
        }
    }

}
