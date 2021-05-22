<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Post;
use App\Models\Slide;
use App\Models\GalaryMedia;
use App\Models\ImageBox;
use Session;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $index_media = Media::where('type',1)->orderBy('id','desc')->get();
        return view('Admin.Media.index_image',compact('index_media'));
    }
    public function moreMedia()
    {   
        $data = Media::where('type',1)->orderBy('id','desc')->paginate(15);
$aa=null;
        foreach ($data as $key => $media) {
            $html = "<div class=\"col-md-2 text-center border-media-product border-media-product_.".$media->id."\"  >
            <img id=\"img_".$media->id."\" src=\"".asset('Media/'.$media->url)."\" width=\".100%\" height=\"100px\" alt=\"\">
            <input type=\"checkbox\" name=\"media_id\" class=\"checkbox-image checkbox\" data-id=\"".$media->id."\" value=\"".$media->id."\">
        </div>";
        $aa .= $html;
        }
        // dd($aa);
        return $aa ;
    }
    public function indexVideo()
    {
        $video = Media::where('type',2)->get();
        return view('Admin.Media.index_video',compact('video'));
    }
    public function delete(Request $request)
    {
        if($filename = $request->input('name'))
        {
            $url = $request->input('url');
            $path=public_path().'/Media/'.$url;
            if(file_exists($path)) {
                unlink($path);
            }
            $media_id = null;
            $data = Media::where('id',$request->input('name'))->delete();
            $data_product = Product::where('product_media_id',$request->input('name'))->update(['product_media_id'=>$media_id]);
            $data_product_media = ProductMedia::where('media_id',$request->input('name'))->delete();
            $data_post = Post::where('media_id',$request->input('name'))->update(['media_id'=>$media_id]);
            $data_slide = Slide::where('media_id',$request->input('name'))->delete();
            $data_galary_media = GalaryMedia::where('media_id',$request->input('name'))->delete();
            $data_image_box = ImageBox::where('media_id',$request->input('name'))->update(['media_id'=>$media_id]);
            $respon['message'] = "success";
            Session::flash('success', 'Ảnh đã được xóa');
            return response()->json($respon);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileStore(Request $request)
    {
        $this->validate($request,
          [
            'dropzone'=>'image|mimes:jpg,jpeg,png,gif|max:2048',
          ],
          [
           'dropzone.mimes'=>'Phải đúng định dạng: jpg,jpeg,png,gif !!!',
           'dropzone.max'=>'Nhập tối đa 2 MB!!!',
           'dropzone.image'=>'Phải là ảnh !!!',
          ]);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('/Media'),$imageName);
        $imageUpload = new Media();
        $id = DB::table('media')->insertGetId(
            array(
            'url' =>$imageName,
            'type'  => 1,
            'user_id' =>Auth::id(),
            'created_at' =>Carbon::now('+7:00')
            )
        );
        $response['id'] = $id;
        $response['url'] = $imageName;
        return response()->json($response);
    }
    public function fileStoreVideo(Request $request)
    {
         $this->validate($request,
          [
            'file'=>'required|mimes:3gb,mp3,mp4|max:20480',
          ],
          [
           'file.mimes'=>'Phải đúng định dạng video !!!',
           'file.max'=>'Nhập tối đa 20MB!!!',
          ]);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('/Media'),$imageName);
        $imageUpload = new Media();
        $imageUpload->url = $imageName;
        $imageUpload->type = 2;
        $imageUpload->user_id = Auth::id();
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $path=public_path().'/Media/'.$filename;
        if(file_exists($path)) {
            unlink($path);
        }
        Media::where('url',$filename)->delete();
        Session::flash('success', 'File ảnh đã được xóa');
        return $filename;  
    }
    //galary ảnh 
    public function index_galary()
    {   
        $index_galary_image = Media::where('type',3)->get();
        return view('Admin.Media.index_image',compact('index_galary_image'));
    }
    //Delete Muti media
    public function deleteMutiMedia(Request $request)
    {   
      $ids = $request->ids;
      Media::whereIn('id',explode(",",$ids))->where('type',1)->delete();
      Session::flash('success','Ảnh được chọn đã được xóa');
      $respone['status'] =true;
      return response()->json($respone);  
    }
}