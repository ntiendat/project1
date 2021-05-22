<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Session;
use Auth;
use Carbon\Carbon;
use DB;


class ProfileController extends Controller
{
     public function index()
    {
        $id = Auth::id();
        $media_share = Media::where('type',1)->get();
        $data['profile'] = User::leftJoin('media','media.id','=','users.avatar')
                                -> where('users.id','=',$id)
                                -> select('users.*','media.url')->first();

        $data['media'] = Media::all();

        // dd($data['profile']);
        return view('Admin.Profile.index',$data);
    }


    public function editProfile(Request $request)
    {
        $this->validate($request,
          [
            'firstname' =>'required|max:255',
            'lastname' =>'required|max:255',
            'email'=>'required|email|max:255'
            
          ],
          [
            'firstname.required'=>'Họ không được trống',
            'firstname.max'=>'Họ không được quá 255 kí tự',
            'lastname.required'=>'Tên không được trống',
            'lastname.max'=>'Tên không được quá 255 kí tự',
            'email.max'=>'Email không được quá 255 kí tự',
            'email.required'=>'email không được để trống',
            'email.email'=>'Không phải định dạng của Email',
            'email.unique'=>'Không được trùng email'
            
        ]);
        // lay 'id' trong phan data ben view
        $id = Auth::id();
        $data = $request->all();
        $a = User::where('id',$id)->update(
            array(
            'firstname' =>$request['firstname'],
            'lastname' =>$request['lastname'],
            'avatar'  => $request['avatar'],
            'email' => $request['email'],
            'created_at' =>Carbon::now()
            )
        );
        Session::flash('success','sửa thông tin thành công');
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }

    // }
    public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $users = DB::table('users')->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                        ->get();
        if($users){
          $stt = 1;
          foreach ($users as $key => $user) {  
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $user->name . '</th> 
              <th>' . $user->email . '</th>
              <th scope="col"><a href='.route('edit.user',['id'=>$user->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.user',['id'=>$user->id]).'" onclick="return confirm(\bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }
    }
}
