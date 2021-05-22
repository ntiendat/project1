<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
// use Validate;
use DB;
class UserController extends Controller
{
     public function index()
    {
        $users = User::orderBy('id','desc')->get();
        // $user=$user->paginate(10)
        return view('Admin.User.index',compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $media =Media::all(); 
        return view('Admin.User.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,
          [
            'firstname'=>'required|max:25',
            'lastname'=>'required|max:25',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|min:6|max:30'
          ],
          [
            'firstname.required'=>'Họ không được trống',
            'firstname.max'=>'Tên không được quá 25 kí tự',
            'lastname.required'=>'Tên không được trống',
            'lastname.max'=>'Tên không được quá 25 kí tự',
            'email.max'=>'Email không được quá 255 kí tự',
            'email.required'=>'email không được để trống',
            'email.email'=>'Không phải định dạng của Email',
            'email.unique'=>'Không được trùng email',
            'password.min'=>'Mật khẩu phải trên 6 ký tự',
            'password.max'=>'Mật khẩu không được quá 30 ký tự',
            'password.required'=>'Password không được để trống',
            
          ]);
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->avatar = 208;
        $user->password  = bcrypt($request->password);
        $user->save();
        Session::flash('success','Thông tin người dùng đã được thêm');
        return redirect(route('index.user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('Admin.User.edit',compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request,
          [
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            // 'email'=>'required|email|max:255',
            'password'=>'required|min:6|max:65',
            'passwordAgain' =>'required|same:password'
          ],
          [
            // 'firstname.required'=>'firstname không được trống',
            'firstname.max'=>'firstname không được quá 255 kí tự',
            // 'lastname.required'=>'lastname không được trống',
            'lastname.max'=>'lastname không được quá 255 kí tự',
            // 'email.max'=>'Email không được quá 255 kí tự',
            // 'email.required'=>'email không được để trống',
            // 'email.email'=>'Không phải định dạng của Email',
            'email.unique'=>'Không được trùng email',
            'password.min'=>'Mật khẩu phải trên 6 ký tự',
            'password.max'=>'Mật khẩu không được quá 65 ký tự',
            'password.required'=>'Password không được để trống',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa đúng'
            
          ]);

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('success', 'Thông tin người dùng đã được sửa'); 
        return redirect(route('index.user'));
    }

    public function resetPassword(Request $request, $id) {

      $user = User::find($id);
      $random = Str::random(40);
      $user->password = bcrypt($random);
      $user->save();

      $data = [
            'content' => 'Mật khẩu mới của quý khách là: ' + $random,
            'created_at' =>Carbon::now()
      ];
      
      //gui mail
      Mail::send('Client.Email.email-contact',$data,function($message) use ($email,$mailto) {
        $message->from($email,'da;');
        $message->to($mailto,$user->email);
        $message->subject('Mật khẩu mới đăng nhâp');
      });

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
        Session::put('success','Thông tin người dùng đã được xóa !');
        return redirect(route('index.user'));
    }

    
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
              <th>' . $user->firstname . '</th> 
              <th>' . $user->lastname . '</th> 
              <th>' . $user->email . '</th>
              <th scope="col" class="tacvu"><a href='.route('edit.user',['id'=>$user->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.user',['id'=>$user->id]).'" onclick="return confirm(\bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }
    }

    public function delete_multiple_user(Request $request){
      $ids = $request->ids;
      User::whereIn('id',explode(",",$ids))->delete();
      return response()->json(['status'=>false,'message'=>"xoá người dùng thành công"]);  
    }
}
