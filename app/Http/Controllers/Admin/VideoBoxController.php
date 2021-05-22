<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\VideoBox;
use App\Models\CategoryLink;
use Illuminate\Http\Request;
use Str;
use Auth;
use DB;
use Session;
use Carbon\Carbon;


class VideoBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video_boxs = VideoBox::leftJoin('media','media.id','=','video_boxs.media_id')
          ->select('video_boxs.*','media.url as mediaUrl')
          ->orderBy('created_at','desc')->get();
        // dd($video_boxs);
        return view('Admin.VideoBoxs.index',compact('video_boxs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('type',4)->get();
        $category_add = Category::where('type',4)->get();
        $media  = Media::where('type',2)->get();
         return view('Admin.VideoBoxs.add',compact('media','category','category_add'));
    }

    public function addCategoryGalary(Request $request)
    {
        $this->validate($request,
          [
           
            'name'=>'required|max:255|unique:category',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!',
           'name.unique'=>'Tên đã tồn tại !!!',
          ]);
        $user_id = Auth::id();
        $id = DB::table('category')->insertGetId(
            array('name' => $request["name"],'desc'=>'add_galary','parent_id' => $request['parent_id'], 'user_id' => $user_id, 'media_id' => 1,'type'=>3)
        );
        $respon['success'] = "Loại Image Box đã được thêm";
        $respon['status'] = true;
        $respon['id'] = $id;
        return response()->json($respon);
    }
    public function store(Request $request)
    {
       $this->validate($request,
            [
                'title'=>'required|max:255',
            ],
            [
                'title.required'=>'Tiêu đề bài viết không được trống',
                // 'title.unique'=>'Tiêu bài viết đã tồn tại',
                'title.max'=>'không được vượt quá 255 kí tự',
          ]);
        $data = $request->all();
        $galary = DB::table('video_boxs')->insertGetId(
            array(
            'title' =>$request['title'],
            'description'  => $request['description'],
            'user_id'  => Auth::id(),
            'url' => $request['url'],
            'media_id' => $request['media_id'],
            'created_at' =>Carbon::now(),
            'category_id' => $request['category'],
            )
        );
        // //add cate
        // if( $request['category'] !=0){
        //      $categorylist = $request['category'];
        //     foreach ($categorylist as $row) {
        //         $charges[] = [
        //             'category_id' => $row,
        //             'link_id' => $galary,
        //             'type' => 3,
        //             'created_at' =>Carbon::now()
        //         ];
        //     }
        //     CategoryLink::insert($charges);
        // }
        Session::flash('success','Video Box đã được thêm');
        $response['success'] = "Image Box đã được thêm";
        $response['status'] = true;
        $response['data'] = $data;
        return response()->json($response);
    }
   
    public function edit(Request $request, $id)
    {
        $data['galary'] = VideoBox::find($id);
        $data['category_old'] = Category::join('video_boxs','video_boxs.category_id', '=', 'category.id')
            ->where('video_boxs.id', $id)
            ->where('type',4)
            ->select('category.id')->get();

        // $data['galary_img'] = Media::join('video_boxs','video_boxs.media_id', '=', 'media.id')
        //     ->where('video_boxs.id', $id)
        //     ->select('media.url')->get();

        $data['category'] = Category::where('type',4)->get();
        $data['category_add'] = Category::where('type',4)->get();
        $data['media']  = Media::where('type',2)->get();

        return view('Admin.VideoBoxs.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required|max:255',
            ],
            [
                'title.required'=>'Tên bài viết không được trống',
                'title.max'=>'không được vượt quá 255 kí tự',
          ]);
        $id = $request['id'];
        $data = $request->all();
        $galary_id = VideoBox::where('id',$id)->update(
            array(
            'title' =>$request['title'],
            'description'  => $request['description'],
            'user_id'  => Auth::id(),
            'url' => $request['url'],
            
            'category_id' => $request['category'],
            'created_at' =>Carbon::now()
            )
        );
        // CategoryLink::where('link_id', $id)->delete();
        // //add cate
        // if($request['category'] != 0){
        //     $categorylist = $request['category'];
        //     foreach ($categorylist as $row) {
        //         $charges[] = [
        //             'category_id' => $row,
        //             'link_id' => $id,
        //             'type' => 3,
        //             'created_at' =>Carbon::now()
        //         ];
        //     }
        //     CategoryLink::insert($charges);
        // }
        Session::flash('success','Video Box đã được sửa');
        //$respon['success'] = "Image box đã được sửa";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $galary =VideoBox::where('id',$request->id)->delete();
        // $category_link = CategoryLink::where('link_id',$id)->delete();
        return redirect(route('index.video.box'))->with('success','Image Box đã được xóa!!');
    }

    public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $video_boxs = DB::table('video_boxs')->where('video_boxs.title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('video_boxs.description', 'LIKE', '%' . $request->search . '%')
                        ->leftJoin('media','video_boxs.media_id', '=', 'media.id')
                        ->select('video_boxs.*','media.url')
                        ->get();
        if($video_boxs){
          $stt = 1;
          foreach ($video_boxs as $key => $video_box) {
            $img = $video_box->media_id == false ? "<img src='' width='50px' height='50px'>"  : "<img src='../../../Media/".$video_box->url."' width='50px' height='50px'>" ;

            $output .= '<tr>
              <th><input type="checkbox" name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $video_box->title . '</th>
              <th> ' . substr($video_box->description,0,50)  . '</th>
              <th> ' . substr($video_box->url,0,50  )  . '</th>

              
              <th scope="col" class="tacvu"><a href='.route('edit.video.box',['id'=>$video_box->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.video.box',['id'=>$video_box->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>'; 
          }
        }
        return response($output);
      }
    }

    public function delete_multiple_video_box(Request $request){
      $ids = $request->ids;
      VideoBox::whereIn('id',explode(",",$ids))->delete();
      return response()->json(['status'=>true,'message'=>"xoá Video Box thành công"]);  
    }

  }