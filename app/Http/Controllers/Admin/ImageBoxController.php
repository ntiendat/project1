<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Post;
use App\Models\Category;
use App\Models\Media;
use App\Models\CategoryLink;
use App\Models\ImageBox;
// use App\Models\TagLink; 
// use App\Models\Tag;
use Illuminate\Http\Request;
use Str;
use Auth;
use DB;
use Session;
use Carbon\Carbon;


class ImageBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image_boxs = ImageBox::leftJoin('media','media.id','=','image_boxs.media_id')
          ->select('image_boxs.*','media.url as media_url')
          ->orderBy('created_at','desc')->get();
        // dd($image_boxs);
        return view('Admin.ImageBoxs.index',compact('image_boxs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('type',3)->get();
        $category_add = Category::where('type',3)->get();
        $media  = Media::where('type',1)->get();
        return view('Admin.ImageBoxs.add',compact('media','category','category_add'));
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
                'title'=>'required|max:255|unique:post',
            ],
            [
                'title.required'=>'Tiêu đề bài viết không được trống',
                'title.unique'=>'Tiêu bài viết đã tồn tại',
                'title.max'=>'không được vượt quá 255 kí tự',
          ]);
        $data = $request->all();
        $galary = DB::table('image_boxs')->insertGetId(
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
        Session::flash('success','Image Box đã được thêm');
        $response['success'] = "Image Box đã được thêm";
        $response['status'] = true;
        $response['data'] = $data;
        return response()->json($response);
    }
   
    public function edit(Request $request, $id)
    {
        $data['galary'] = ImageBox::find($id);
        $data['category_old'] = Category::join('image_boxs','image_boxs.category_id', '=', 'category.id')
            ->where('image_boxs.id', $id)
            ->where('type',3)
            ->select('category.id')->get();

        $data['galary_img'] = Media::join('image_boxs','image_boxs.media_id', '=', 'media.id')
            ->where('image_boxs.id', $id)
            ->select('media.url','media.id')->first();

        //dd($data['galary_img']);

        $data['category'] = Category::where('type',3)->get();
        $data['category_add'] = Category::where('type',3)->get();
        $data['media']  = Media::where('type',1)->get();

        return view('Admin.ImageBoxs.edit',$data);
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
        //return response($data);

        $galary_id = ImageBox::where('id',$id)->update(
            array(
            'title' =>$request['title'],
            'description'  => $request['description'],
            'user_id'  => Auth::id(),
            'url' => $request['url'],
            'media_id' => $request['media_id'],
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
        Session::flash('success','Image Box đã được sửa');
        $respon['success'] = "Image box đã được sửa";
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
        $galary =ImageBox::where('id',$request->id)->delete();
        // $category_link = CategoryLink::where('link_id',$id)->delete();
        return redirect(route('index.image.box'))->with('success','Image Box đã được xóa!!');
    }

    public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $image_boxs = DB::table('image_boxs')->where('image_boxs.title', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('image_boxs.description', 'LIKE', '%' . $request->search . '%')
                        ->leftJoin('media','image_boxs.media_id', '=', 'media.id')
                        ->select('image_boxs.*','media.url as media_url')
                        ->get();
                  // dd($image_boxs);

        if($image_boxs){
          $stt = 1;
          foreach ($image_boxs as $key => $image_box) {
            // $img = $image_box->media_id == null ? "<img src='../../../Media/".$image_box->media_url."' width='50px' height='50px'>" : "<img src='' width='50px' height='50px'>"   ;
            $output .= '<tr>
              <th><input type="checkbox" name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $image_box->title . '</th>
              <th>' . substr($image_box->description,0,50) .  '</th>
              <th scope="col"><img src="../../Media/'. $image_box->media_url.'" width="50px" height="50px"></th>
              <th>'. $image_box->url .'</th>
              <th scope="col"><a href='.route('edit.image.box',['id'=>$image_box->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.image.box',['id'=>$image_box->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>'; 
          }
        }
        return response($output);
      }
    }

    public function delete_multiple_galary_image(Request $request){
      $ids = $request->ids;
      ImageBox::whereIn('id',explode(",",$ids))->delete();
      return response()->json(['status'=>true,'message'=>"xoá bài viết thành công"]);  
    }

  }