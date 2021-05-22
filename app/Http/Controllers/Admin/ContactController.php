<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
// use Validator;
use Auth;
use DB;
use Carbon\Carbon;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        $contacts = Contact::orderBy('status','asc')->paginate(10);
        return view('Admin.Contact.list-contact',compact('contacts'));
    }

    public function getListByStatus(Request $request)
    {
        $output ='';
        $contacts = DB::table('contact')->where('status','=',$request->status_id)        
                        ->orderBy('status', 'desc')
                        ->paginate(10);
                        
        if($contacts){
          $stt = 1;
          foreach ($contacts as $key => $contact) {
            //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
            $option1 = '';
            $option2 = '';
            $option3 = '';
            switch ($contact->status) {
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
              
              default:
                # code...
                break;
            }
            $output .= '<tr>
              <th><input type="checkbox" class="checkbox" data-id='.$contact->id.'></th>
              <th>' . $stt++ . '</th>
              <th>' .  $contact->name . '</th>
              <th>' .  $contact->email . '</th> 
              <th>' .  $contact->address . '</th> 
              <th>' .  $contact->phone . '</th> 
              <th>' .  $contact->content . '</th>
              <th>
                <select name="status-contact" class="form-control optionstatus" data-id='.$contact->id.'>
                  <option value="0">--</option>
                  <option value="1" '. $option1 .'>Tiếp nhận</option>
                  <option value="2" '. $option2 .'>Không liên lạc được</option>
                  <option value="3" '. $option3 .'>Đã xử lý</option>
                </select>
              </th>

              <th scope="col" class="tacvu">
                <a onclick="deletecontact(this,'.$contact->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a>
            </tr>';

          }
        }
        $data['data'] = $output;
        $data['paging'] = '<div class="row">'.$contacts->render().'</div>';
        return response($data);
    }


    //  public function getProcessed(Request $request)
    // {
    //      $contacts = Contact::where('status',2)->paginate(10);
    //     return view('Admin.Contact.list-contact-success',compact('contacts'));
    // }
     public function getHandleContact(Request $request,$id)
    {
         $contact = Contact::find($id);
         $contact->status = 2;
         $contact->save();
        return redirect(route('list.contact'))->with('success','Liên hệ đã được xử lý !!! ');
    }
     public function getDetailContact(Request $request,$id) 
    {
        $contact = Contact::find($id);
        return view('Admin.Contact.detail-contact',compact('contact'));
    }
    public function getNotContact (Request $request,$id) 
    {
         $contact = Contact::find($id);
         $contact->status = 3;
         $contact->save();
        return redirect(route('list.contact'))->with('success','Không liên lạc được !!! ');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function destroy(Request $request)
    {
        $contact = Contact::find($request->id)->delete();
        return redirect(route('list.contact'))->with('success','Thông tin đã được xóa');
        
    }
    
    public function searchPendding(Request $request)
    {

        if($request->ajax()){
          if(isset($request->contact_status)){
            if($request->contact_status != null ){
              $search = $request->search;
              $contact_status = $request->contact_status;
              $output ='';
              $contacts = DB::table('contact')->where('status','=',$contact_status)
                              ->where(function($query) use ($search){
                              $query->where('name', 'LIKE', '%' . $search . '%' )
                              ->orWhere('email', 'LIKE', '%' . $search . '%' )
                              ->orWhere('address', 'LIKE', '%' . $search . '%' )
                              ->orWhere('phone', 'LIKE', '%' . $search . '%' )
                              ->orwhere('content', 'LIKE', '%' .$search. '%')
                              ->orderBy('status', 'desc');
                              })->paginate(10);
            }else{
                $search = $request->search;
                $output ='';
                $contacts = DB::table('contact')->where('name', 'LIKE', '%' . $search . '%' )
                                ->orWhere('email', 'LIKE', '%' . $search . '%' )
                                ->orWhere('address', 'LIKE', '%' . $search . '%' )
                                ->orWhere('phone', 'LIKE', '%' . $search . '%' )
                                ->orwhere('content', 'LIKE', '%' .$search. '%')
                                ->orderBy('status', 'desc')
                                ->paginate(10);
            }
            if($contacts){
                $stt = 1;
                foreach ($contacts as $key => $contact) {
                    $option1 = '';
                    $option2 = '';
                    $option3 = '';
                    switch ($contact->status) {
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
                      
                      default:
                        # code...
                        break;
                    }
                  $output .= '<tr>
                    <th><input type="checkbox" name=""></th>
                    <th>' . $stt++ . '</th>
                    <th>' .  $contact->name . '</th>
                    <th>' .  $contact->email . '</th> 
                    <th>' .  $contact->address . '</th> 
                    <th>' .  $contact->phone . '</th> 
                    <th>' .  $contact->content . '</th>
                    <th>
                      <select name="status-contact" class="form-control optionstatus" data-id='.$contact->id.'>
                        <option value="0">--</option>
                        <option value="1" '. $option1 .'>Tiếp nhận</option>
                        <option value="2" '. $option2 .'>Không liên lạc được</option>
                        <option value="3" '. $option3 .'>Đã xử lý</option>
                      </select>
                    </th>
                    <th scope="col" class="tacvu">
                      <a onclick="deletecontact(this,'.$contact->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a>
                  </tr>';
                }
              }
                $data['data'] = $output;
                $data['paging'] = '<div class="row">'.$contacts->render().'</div>';
                return response($data);
          }
        }
          
    }


    public function searchSuccess(Request $request)
    {
        if($request->ajax()){ 
            $output ='';
               $contacts = DB::table('contact')->where('status','=',2)
                            ->where(function($query) use ($search){
                            $query->where('name', 'LIKE', '%' . $search . '%' )
                            ->orWhere('email', 'LIKE', '%' . $search . '%' )
                            ->orWhere('address', 'LIKE', '%' . $search . '%' )
                            ->orWhere('phone', 'LIKE', '%' . $search . '%' )
                            ->orwhere('content', 'LIKE', '%' .$search. '%')
                            ->orderBy('status', 'desc');
                            })->paginate(10);
            if($contacts){
              $stt = 1;
              foreach ($contacts as $key => $contact) {
                $status = $contact->status == 1 ? "chưa xử lý" : "đã xử lý";
                $output .= '<tr>
                  <th><input type="checkbox" name=""></th>
                  <th>' . $stt++ . '</th>
                  <th>' .  $contact->name . '</th>
                  <th>' .  $contact->email . '</th> 
                  <th>' .  $contact->address . '</th> 
                  <th>' .  $contact->phone . '</th> 
                  <th>' .  $contact->content . '</th>
                  <th>
                    <select name="status-contact" class="form-control optionstatus" data-id='.$contact->id.'>
                      <option value="0">--</option>
                      <option value="1" '. $option1 .'>Tiếp nhận</option>
                      <option value="2" '. $option2 .'>Không liên lạc được</option>
                      <option value="3" '. $option3 .'>Đã xử lý</option>
                    </select>
                  </th>
                  <th scope="col" class="tacvu">
                      <a onclick="deletecontact(this,'.$contact->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a>
                  </th>
                </tr>';
              }
            }
            return response($output);
        }
    }

    public function delete_multiple_contact_susscess(Request $request){
        $ids = $request->ids;
        Contact::whereIn('id',explode(",",$ids))->where('status',2)->delete();
        return response()->json(['status'=>true,'message'=>"xoá danh sach liên hệ thành công"]);  
    }

    public function delete_multiple_contact_pendding(Request $request){
        $ids = $request->ids;
        Contact::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"xoá danh sách liên hệ thành công"]);  
    }

    public function updateStatusContact(Request $request){
      $data = $request->all();

      $id = $request['id'];
      $status= $request['status'];

      //return response()->json($id);


      $contact = Contact::where('id',$id)->update(
            array(
            'status' =>$status,
            'updated_at' =>Carbon::now('+7:00')
            )
        );
        // $respon['success'] = "Bài viết đã được sửa";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }

}
