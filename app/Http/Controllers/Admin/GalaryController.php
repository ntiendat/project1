<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galary;
use App\Models\Media;
use App\Models\GalaryMedia;
use Illuminate\Http\Request;
use Carbon\Carbon;

// use Validator;
use Auth;
use DB;
use Session;

class GalaryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $galarys = Galary::orderBy('id','desc')->get();
        // dd($galarys); 

        $galary_image = GalaryMedia::join('media','galary_media.media_id','=','media.id')->get();

        $data['galary'] = $galarys;
        $data['galary_image'] = $galary_image;

                        
        // dd($galarys); 
        return view('Admin.Galary.index',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $media  = Media::all();
        return view('Admin.Galary.add',compact('media'));
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
            'title'=>'required|max:255',
          ],
          [
           'title.required'=>'Không được trống !!!',
           'title.max'=>'Nhập tối đa 255 kí tự !!!',
           
          ]);

          $galary = DB::table('galary')->insertGetId(
              array(
              'title' =>$request['title'],
              'user_id'  => Auth::id(),
              'created_at' =>Carbon::now('+7:00')
              )
          );

        if($request['media_id'] != 0){
            $mediaList = explode(",", $request['media_id']);
            foreach ($mediaList as $row) {
              $charges2[] = [
                  'media_id' => $row,
                  'galary_id' => $galary,
                  'created_at' =>Carbon::now()
              ];
          }
          GalaryMedia::insert($charges2);
        }

        Session::flash('success','Garary đã được thêm');
        $respon['status'] = true;
        return response()->json($respon);
        // return redirect(route('index.galary'))  ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
   
    public function edit(Request $request, $id)
    {   $media  = Media::all();
        $galary = Galary::find($id);
        $galary_medias= GalaryMedia::join('galary','galary.id', '=', 'galary_media.galary_id')
            ->where('galary.id', $id)
            ->select('galary_media.media_id')->get();
        $galary_img = GalaryMedia::join('galary','galary.id', '=', 'galary_media.galary_id')
        ->join('media','galary_media.media_id', '=', 'media.id')
            ->where('galary.id', $id)
            ->select('media.url','media.id')->get();
         return view('Admin.Galary.edit',compact('galary','media','galary_img','galary_medias'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostTag  $postTag
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
        $id = $request['id'];
        $galary = Galary::where('id',$id)->update(
            array(
            'title' =>$request['title'],
            'user_id'  => Auth::id(),
            'created_at' =>Carbon::now('+7:00'),
            )
        );


        GalaryMedia::where('galary_id',$id)->delete();
        if($request['media_id'] != 0){
          //dd($request['media_id']);
            $cut = rtrim($request['media_id'],", ");
            $mediaList = explode(",",$cut);
  
            // dd($mediaList);
            foreach ($mediaList as $row) {
              $charges2[] = [
                  'media_id' => $row,
                  'galary_id' => $id,
                  'created_at' =>Carbon::now('+7:00'),
              ];
          }
        }
          GalaryMedia::insert($charges2);
          Session::flash('success','Garary đa được sửa');
        // return redirect(route('index.galary'));
    }

     public function destroy(Request $request)
    {
        $galary = Galary::where('id',$request->id)->delete();
        return redirect(route('index.galary'))->with('success','Galary đã được xóa');
        
    }
    public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';

        $galarys = DB::table('galary')
                        ->where('title', 'LIKE', '%' . $request->search . '%')
                        ->get();

         $galary_image = GalaryMedia::join('media','galary_media.media_id','=','media.id')->get();

        if($galarys){
          $stt = 1;
          foreach ($galarys as $key => $galary) {
               $imgs = "";
              foreach($galary_image as $key => $image) {
                  if ($galary->id == $image->galary_id) {
                      $imgs = $imgs . '<img src="../../Media/' . $image->url . '" alt="" width="50px" height="50px">';
                  }
              }


           
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th scope="col"> ' .  $galary->title . '
              </th> 
              <th> '. $imgs .' </th> 
              <th scope="col" class="tacvu"><a href='.route('edit.galary',['id'=>$galary->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.galary',['id'=>$galary->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        return response($output);
      }
    }
    // //xoá checkbox
    // public function delete_multiple_tag_(Request $request){
    //    $ids = $request->ids;

    //    Galary::whereIn('id',explode(",",$ids))->where('type',2)->delete();

    //     return response()->json(['status'=>true,'message'=>"xoá thẻ thành công"]);  
    // }

    // public function delete_multiple_tag_(Request $request){
    //    $ids = $request->ids;

    //    Galary::whereIn('id',explode(",",$ids))->where('type',1)->delete();

    //     return response()->json(['status'=>true,'message'=>"xoá thẻ thành công"]);  
    // }


}
