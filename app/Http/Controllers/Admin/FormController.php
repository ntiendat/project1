<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index(Request $request)
    {
        $forms = Form::orderBy('id','desc')->get();
        return view('Admin.Form.index',compact('forms'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = "<form id='form-data' method='POST'><input name='_token' type='hidden' value='{{csrf_token()}}' />
                  <div class='form-group row'>
                    <div class='col-md-3'>T&ecirc;n của bạn:</div>
                    <div class='col-md-9'><input name='name' size='60' type='text' value='' /></div>
                  </div>

                  <div class='form-group row'>
                    <div class='col-md-3'>Email của bạn:</div>
                    <div class='col-md-9'><input name='email' size='60' type='text' value='' /></div>
                  </div>

                  <div class='form-group row'>
                    <div class='col-md-3'>Địa chỉ:</div>
                    <div class='col-md-9'><input name='address' size='60' type='text' value='' /></div>
                  </div>

                  <div class='form-group row'>
                    <div class='col-md-3'>Số điện thoại:</div>
                    <div class='col-md-9'><input name='phone' size='60' type='text' value='' /></div>
                  </div>

                  <div class='form-group row'>
                    <div class='col-md-3'>Tin nhắn gửi:</div>
                    <div class='col-md-9'><textarea cols='63' name='message' rows='10'></textarea></div>
                  </div>
                  
                  <div class='form-group row'>
                    <div class='col-md-9'><p><input type='button' name='send_email' value='Send email'></p></div>
                  </div>
                </form>";

        

        return view('Admin.Form.add',compact('form'));
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
            'name'=>'required|unique:form',
            'email_to'=>'required|max:255|email',
        ],
        [
            'name.required'=>'Không được để trống',
            'name.unique'=>'Tên đã  tồn tại rồi',
            'email_to.required'=>'Không được để trống',
            'email_to.max'=>'Không được quá 255 kí tự',
            'email_to.email'=>'Phải là định dạng kiểu email',
        ]);
        $requestData = $request->all();
        // dd($requestData);
        $name_replace = 'name="name" id="name" class="name"';
        $email_replace = 'name="email" id="email" class="email"';
        $address_replace = 'name="address" id="address" class="address"';
        $phone_replace = 'name="phone" id="phone" class="phone"';
        $message_replace = 'name="message" id="message" class="message"';
        $send_email_replace = 'name="send_email" id="send_email" class="send_email"';

        $name_search = 'name="name"';
        $email_search = 'name="email"';
        $address_search = 'name="address"';
        $phone_search = 'name="phone"';
        $message_search = 'name="message"';
        $send_email_search = 'name="send_email"'; 

        $subject = $requestData['content'];
        $search = [$name_search, $email_search, $address_search, $phone_search, $message_search,$send_email_search];
        $replace = [$name_replace, $email_replace, $address_replace, $phone_replace, $message_replace,$send_email_replace];
        $result = str_replace($search, $replace, $subject);
        // var_dump($result);
        $form = DB::table('form')->insertGetId(
            array(
            'email_to'=>$request->email_to,
            'name' =>'[form_page_'.$request->name.'_'.rand(0,100000).']',
            'value' =>$result,
            'user_id'  => Auth::id(),
            'created_at' =>Carbon::now()
            )
        );
        Session::flash('success','Form đã được thêm');
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $form = Form::find($id);
        
         return view('Admin.Form.edit',compact('form'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,
        [
            'value'=>'required',
            'name'=>'required',
            'email_to'=>'required|max:255|email',
        ],
        [
            'value.required'=>'Không được để trống',
            'name.required'=>'Không được để trống',
            'name.unique'=>'Tên đã  tồn tại rồi',
            'email_to.required'=>'Không được để trống',
            'email_to.max'=>'Không được quá 255 kí tự',
            'email_to.email'=>'Phải là định dạng kiểu email',
        ]);
        // $data = $request->all();
        $form = Form::find($id);
        $form->email_to = $request->email_to;
        $form->name = $request->name;
        $form->value = $request->value;
        $form->user_id =Auth::id();
        $form->created_at =Carbon::now();
        $form->save();
        return redirect()->back()->with('success','Form đã được sửa !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postslide  $postslide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $form = Form::where('id',$request->id)->delete();
        return redirect(route('index.form'))->with('success','Form đã được xóa');
        
    }
    // public function search(Request $request)
    // {
    // $slide_img= Media::join('slide','media.id','=','slide.media_id')
    //                 ->select('media.*')
    //                 ->get();
    //   if($request->ajax()){ 
    //     $output ='';
    //     $slides = DB::table('slide')->where('name', 'LIKE', '%' . $request->search . '%')
    //                     ->orWhere('url', 'LIKE', '%' . $request->search . '%')
    //                     ->get();
    //     if($slides){
    //       $stt = 1;
    //       foreach ($slides as $key => $slide) {
    //          $output .= '<tr>
    //           <th><input type="checkbox"  name=""></th>
    //           <th>' . $stt++ . '</th>
    //           <th>' . $slide->url . '</th>
    //           <th>
    //             <img src="../../Media/{{$slide->MediaSlide->url}}" alt="" width="50px" height="50px">
    //           </th>
    //           <th scope="col"><a href='.route('edit.slide',['id'=>$slide->id]).'><i class="fa fa-edit tacvu"></i></a>
    //           <a href="'.route('delete.slide',['id'=>$slide->id]).'" onclick="return confirm(\bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
    //         </tr>';
    //       }
    //     }
    //     return response($output);
    //   }
    // }

    public function delete_multiple_form(Request $request){
        $a = $request->a;
        Form::whereIn('id',explode(",",$a))->delete();
        return response()->json(['status'=>true,'message'=>"xoá Form thành công"]);  
    }

}
