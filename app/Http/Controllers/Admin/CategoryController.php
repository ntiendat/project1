<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Lang;
use Auth;
use DB;
use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPost()
    {
        $category_post = Category::leftJoin('category as categoryparent','category.parent_id','=','categoryparent.id')
                            ->select('category.*','categoryparent.name as parent_name')
                            ->where('category.type',1)->orderBy('category.id','desc')->get();
        return view('Admin.Category.index_post',compact('category_post'));
    }   
    public function indexProduct()
    {   
        //lien ket trong 1 bang
        $category_product = Category::leftJoin('category as categoryparent','category.parent_id','=','categoryparent.id')
                            ->leftjoin('media','media.id','=','category.media_id')
                            ->select('category.*','categoryparent.name as parent_name','media.url')
                            ->where('category.type',2)->orderBy('category.id','desc')->get();
        // dd($category_product);
        return view('Admin.Category.index_product',compact('category_product'));
    }
    
    public function createPost()
    {
        $category = Category::where('type',1)->get();
        return view('Admin.Category.add-post',compact('category'));
    }
    public function createProduct()
    {
        $category = Category::where('type',2)->get();
        $lang = Lang::all();
        return view('Admin.Category.add-product',compact(['category','lang']));
    }

    public function index($type)
    {
        $category = Category::orderBy('id','desc')->where('type',$type)->get();
        if($type==3){
          return view('Admin.Category.index_images',compact('category'));
        } else {
          return view('Admin.Category.index_video',compact('category'));
        }
        
    }

    public function create($type)
    {
        $type = $type;
        $category = Category::where('type',$type)->get();
        return view('Admin.Category.add',compact('category','type'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $this->validate($request,
      $category_post = new Category;
      $category_post->name = $request->name;
      $category_post->desc = $request->desc;
      $category_post->parent_id = $request->parent_id;
      $category_post->media_id  = 1;
      $category_post->type =$request->type;
      $category_post->user_id = Auth::id();
      $category_post->save();

      if($request->type==3){
        return redirect(route('index.categoryimage',$request->type))->with('success','Loại danh mục đã được thêm');
      } else {
        return redirect(route('index.categoryvideo',$request->type))->with('success','Loại danh mục đã được thêm');
      }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePost(Request $request)
    {
        $category_post = new Category;
        $category_post->name = $request->name;
        $category_post->desc = $request->desc;
        $category_post->parent_id = $request->parent_id;
        $category_post->media_id  = 1;
        $category_post->type =1;
        $category_post->user_id = Auth::id();
        $category_post->save();
        return redirect(route('index.post.category'))->with('success','Loại danh mục đã được thêm');
    }

    public function storeProduct(Request $request)
    {

      // dd($request);
      $this->validate($request,
        [
          'name'=>'required|max:255',
        ],
        [
         'name.required'=>'Không được trống !!!',
         'name.max'=>'Nhập tối đa 255 kí tự !!!'
        ]);
      $category_product = new Category;
      $category_product->name = $request->name;
      $category_product->lang_id = $request->lang;
      $category_product->desc = $request->desc;
      $category_product->parent_id  = $request->parent_id;
      $category_product->media_id  = $request->image_pro;
      $category_product->displayed  = $request->displayed != null ? true : false;
      $category_product->type = 2;
      $category_product->user_id = Auth::id();
      $category_product->save();
      Session::flash('success','Loại danh mục đã được thêm');
      return redirect(route('index.product.category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    public function edit($id,$type)
    {
        $type = $type;
        $category = Category::find($id);
        return view('Admin.Category.edit',compact('category','type'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,
        [
          'name'=>'required|max:255',
        ],
        [
         'name.required'=>'Không được trống !!!',
         'name.max'=>'Nhập tối đa 255 kí tự !!!'
        ]);
      $category = Category::find($id);
      $category->name = $request->name;
      $category->desc = $request->desc;
      // $category->parent_id = $request->parent_id;
      $category->name = $request->name;
      $category->media_id =1;
      $category->type =$request->type;
      $category->user_id = Auth::id();
      $category->save();
      
      if($request->type==3){
        return redirect(route('index.categoryimage',$request->type))->with('success','Loại danh mục đã được sửa');
      } else {
        return redirect(route('index.categoryvideo',$request->type))->with('success','Loại danh mục đã được sửa');
      }
    }
     public function destroy($id,$type)
    {
       DB::table('category')->where('id',$id)->where('type',$type)->delete();
       DB::table('category')->where('parent_id',$id)->delete();

       return redirect()->back()->with('success','Danh mục đã được xóa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function editPost($id)
    {
        $category = Category::find($id);
        $category_id = Category::where('type',1)->get();
        return view('Admin.Category.edit-post',compact('category','category_id'));
    }
    public function editProduct($id)
    {
        $category = Category::leftJoin('media','media.id','=','category.media_id')
                            ->select('category.*','media.url')
                            ->where('category.id',$id)
                            ->first();
        // dd($category);
        $category_id = Category::where('type',2)->get();
        $lang = Lang::all();
        return view('Admin.Category.edit-product',compact('category','category_id','lang'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request, $id)
    {
        $this->validate($request,
          [
           
            'name'=>'required|max:255',
          ],
          [
           'name.required'=>'Không được trống !!!',
           'name.max'=>'Nhập tối đa 255 kí tự !!!'
          ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->media_id =1;
        $category->type =1;
        $category->user_id = Auth::id();
        $category->save();
       
        return redirect(route('index.post.category'))->with('success','Loại danh mục đã được sửa');
    }

    public function updateProduct(Request $request, $id)
    {
      $this->validate($request,
        [
         
          'name'=>'required|max:255',
        ],
        [
         'name.required'=>'Không được trống !!!',
         'name.max'=>'Nhập tối đa 255 kí tự !!!'
        ]);
      $category = Category::find($id);
      $category->name = $request->name;
      $category->desc = $request->desc;
      $category->lang_id = $request->lang;
      $category->parent_id = $request->parent_id;
      $category->name = $request->name;
      $category->media_id  = $request->image_pro;
      $category->displayed  = $request->displayed != null ? true : false;
      $category->type =2;
      $category->user_id = Auth::id();
      $category->save();
      return redirect(route('index.product.category'))->with('success','Loại danh mục đã được sửa');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroyPost($id)
    {
      DB::table('category')->where('id',$id)->delete();
      DB::table('category')->where('parent_id',$id)->delete();
      return redirect(route('index.post.category'))->with('success','Danh mục đã được xóa');
    }

    public function destroyProduct($id)
    {
      DB::table('category')->where('id',$id)->delete();
      DB::table('category')->where('parent_id',$id)->delete();
      return redirect(route('index.product.category'))->with('success','Danh mục đã được xóa');
    }

     public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $cate = DB::table('category')
                        ->where('type',$request->type)
                        ->Where('name', 'LIKE', '%' . $request->search . '%')
                        // ->Join('media','category.media_id', '=', 'media.id')
                        ->get();
        if($cate){
          $stt = 1;
          foreach ($cate as $key => $cate) {
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $cate->name . '</th>
              <th>' . $cate->desc . '</th>
              <th>' . $cate->parent_id . '</th>
              <th scope="col" class="tacvu"><a href='.route('edit.category',['id'=>$cate->id,'type'=>$request->type]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.category',['id'=>$cate->id,'type'=>$request->type]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>

            </tr>';
          }
        }
        return response($output);
      }
    }

    //  public function searchVideoBox(Request $request)
    // {
    //   if($request->ajax()){ 
    //     $output ='';
    //     $cate = DB::table('category')
    //                     ->where('type', $request->type)
    //                     ->Where('name', 'LIKE', '%' . $request->search . '%')
    //                     // ->Join('media','category.media_id', '=', 'media.id')
    //                     ->get();
    //     if($cate){
    //       $stt = 1;
    //       foreach ($cate as $key => $cate) {
    //         $output .= '<tr>
    //           <th><input type="checkbox"  name=""></th>
    //           <th>' . $stt++ . '</th>
    //           <th>' . $cate->name . '</th>
    //           <th>' . $cate->desc . '</th>
    //           <th>' . $cate->parent_id . '</th>
    //           <th scope="col"><a href='.route('edit.category',['id'=>$cate->id,'type'=>$request->type]).'><i class="fa fa-edit tacvu"></i></a>
    //           <a href="'.route('delete.category',['id'=>$cate->id,'type'=>$request->type]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>

    //         </tr>';
    //       }
    //     }
    //     return response($output);
    //   }
    // }

    public function searchPost(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $cate_post = DB::table('category')
                        ->where('type',1)
                        ->Where('name', 'LIKE', '%' . $request->search . '%')
                        ->get();
        // <th scope="col"><img src="../../Media/'.$cate_post->url.'" alt="" width="50px" height="50px"></th>
        
        if($cate_post){
          $stt = 1;
          foreach ($cate_post as $key => $cate_post) {
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $cate_post->name . '</th>
              <th>' . $cate_post->desc . '</th>
              <th>' . $cate_post->parent_id . '</th>

              <th scope="col"><a href='.route('edit.category.post',['id'=>$cate_post->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.category.post',['id'=>$cate_post->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>

            </tr>';
          }
        }
        return response($output);
      }
    }
    public function searchProduct(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $cate_product = DB::table('category')
                        ->where('type',2)
                        ->where('name', 'LIKE', '%' . $request->search . '%')
                        
                        // ->leftJoin('media','category.media_id', '=','media.id')
                        ->get();
        // <th scope="col"><img src="../../Media/'.$cate_pro->url.'" alt="" width="50px" height="50px"></th>
        if($cate_product){
          $stt = 1;
          foreach ($cate_product as $key => $cate_pro) {
            $output .= '<tr>
              <th><input type="checkbox"  name=""></th>
              <th>' . $stt++ . '</th>
              <th>' . $cate_pro->name . '</th>
              <th>' . $cate_pro->desc . '</th>
              <th>' . $cate_pro->parent_id . '</th>

              <th scope="col"><a href='.route('edit.category.product',['id'=>$cate_pro->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a href="'.route('delete.category.product',['id'=>$cate_pro->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>

            </tr>';
          }
        }
        return response($output);
      }
    }

    public function delete_multiple_category_product(Request $request){
        $ids = $request->ids;
        Category::whereIn('id',explode(",",$ids))->where('type',2)->delete();
        return response()->json(['status'=>true,'message'=>"xoá danh mục sản phẩm thành công"]);  
    }

    public function delete_multiple_category_post(Request $request){
        $ids = $request->ids;
        Category::whereIn('id',explode(",",$ids))->where('type',1)->delete();
        return response()->json(['status'=>true,'message'=>"xoá danh mục bài viết thành công"]);  
    }
}
