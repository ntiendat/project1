<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Lang;
use App\Models\Media;
use App\Models\Category;
use App\Models\CategoryLink;
use App\Models\ProductTag;
use App\Models\ProductMedia;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\ProductRequest;
use Str;
use Carbon\Carbon;
use Auth;
use DB;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorys = Category::get();
        // dd($request->check_all);
        $product_media =Media::join('product','product.product_media_id','=','media.id')
                              ->select('media.url')
                              ->get();
        // dd($product_media);
        $products = Product::leftJoin('media','media.id','=','product.product_media_id')
                                ->join('category_link','product.id','=','category_link.link_id')
                                ->join('category','category_link.category_id','=','category.id')
                                ->select('product.*','media.url','category.name')->orderBy('id','desc')->paginate(10);

      

        return view('Admin.Product.index',compact('products','product_media','categorys'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request,$category_id)
    {

        //dd($category_id);
        $categorys = Category::get();
        // dd($request->check_all);
        $product_media =Media::join('product','product.product_media_id','=','media.id')
                              ->select('media.url')
                              ->get();
        // dd($product_media);
        $products = Product::leftJoin('media','media.id','=','product.product_media_id')
                                ->join('category_link','product.id','=','category_link.link_id')
                                ->join('category','category_link.category_id','=','category.id')
                                ->where('category.id',$category_id)
                                ->select('product.*','media.url','category.name')->orderBy('id','desc')->paginate(10);

      

        return view('Admin.Product.index',compact('products','product_media','categorys','category_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCategoryProduct(Request $request,$id){

    }

    public function create()
    {
        $lang = Lang::all();
        $category = Category::where('type',2)->get();
        $category_add = Category::where('type',2)->get();
        $tag = Tag::where('type',2)->get();
        $media  = Media::where('type',1)->get();
        return view('Admin.Product.add',compact('media','category','tag','category_add','lang'));
    }


    public function addCategoryPro(Request $request)
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
            array('name' => $request["name"],'desc'=>'add_pro','parent_id' => $request['parent_id'], 'user_id' => $user_id, 'media_id' => 1,'type'=>2)
        );
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['id'] = $id;
        return response()->json($respon);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->promotion_price){
        $this->validate($request,
        [
          'price'=>'required|numeric|max:10000000000|integer',
          'title'=>'required|max:255',
          'promotion_price'=>'numeric|greater_than_field:price|integer',
        ],
        [
         'promotion_price.greater_than_field'=>'Không được lớn hơn giá thực !!!',
         'price.integer'=>'Phải là số nguyên !!!',
         'promotion_price.integer'=>'Phải là số nguyên !!!',
         'price.required'=>'Không được trống !!!',
         'price.numeric'=>'Phải là số !!!',
         'price.max'=>'Không được lớn hơn 10.000.000.000 VND !!!',
         'promotion_price.numeric'=>'Phải là số !!!',
         'promotion_price.max'=>'Không được lớn hơn giá thực !!!',
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         
        ]);
      }elseif($request->price){
        $this->validate($request,
        [
          'price'=>'numeric|max:10000000000|integer',
          'title'=>'required|max:255',
        ],
        [
         'price.numeric'=>'Phải là số !!!',
         'price.integer'=>'Phải là số nguyên !!!',
         'price.max'=>'Không được lớn hơn 10.000.000.000 VND !!!',
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         
        ]);

      }elseif($request->price && $request->promotion_price){
        $this->validate($request,
        [
          'price'=>'numeric|max:10000000000|integer',
          'promotion_price'=>'numeric|greater_than_field:price|integer',
          'title'=>'required|max:255',
        ],
        [
         'price.numeric'=>'Phải là số !!!',
         'price.integer'=>'Phải là số nguyên !!!',
         'promotion_price.integer'=>'Phải là số nguyên !!!',
         'promotion_price.greater_than_field'=>'Không được lớn hơn giá thực !!!',
         'price.max'=>'Không được lớn hơn 10.000.000.000 VND !!!',
         'promotion_price.after_or_equal'=>'Không được lớn hơn giá thực !!!',
         'promotion_price.numeric'=>'Phải là số !!!',
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         
        ]);
      }else{
        $this->validate($request,
        [
          'title'=>'required|max:255',
        ],
        [
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         
        ]);
      }
        
        $data = $request->all();
        $product_id = DB::table('product')->insertGetId(
            array(
            'title' =>$request['title'],
            'content'  => $request['content'],
            'principles'  => $request['principles'],
            'parameter'  => $request['parameter'],
            'short_content' =>$request['short_content'],
            'price'  => $request['price'],
            'lang_id'  => $request['lang'],
            'promotion_price'  => $request['promotion_price'],
            'user_id'  => Auth::id(),
            'slug' => Str::slug($request->title,'-'),
            'product_media_id' => $request['product_media_id'],
            'created_at' =>Carbon::now()
            )
        );
        //add cate
        $categorylist = $request['category'];
        if($categorylist != 0){
          foreach ($categorylist as $row) {
            $charges[] = [
                'category_id' => $row,
                'link_id' => $product_id,
                'type' => 2,
                'created_at' =>Carbon::now()
            ];
          }
          CategoryLink::insert($charges);
        }
        
        //add tag
        $tagList = $request['tag'];
          if($tagList != 0){
            foreach ($tagList as $row) {
            $charges1[] = [
                'tag_id' => $row,
                'product_id' => $product_id,
                'created_at' =>Carbon::now()
            ];
          }
          ProductTag::insert($charges1);
        }
        //add img
       
        if($request['media_id'] != 0){
            $mediaList = explode(",", $request['media_id']);
            foreach ($mediaList as $row) {
              $charges2[] = [
                  'media_id' => $row,
                  'product_id' => $product_id,
                  'created_at' =>Carbon::now()
              ];
          }
          ProductMedia::insert($charges2);
        }


        Session::flash('success', 'Thêm sản phẩm thành công'); 
        // $respon['success'] = "Thêm sản phẩm thành công";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
   public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('/Media'),$imageName);
        $imageUpload = new Media();
        $imageUpload->url = $imageName;
        $imageUpload->type = 1;
        $imageUpload->user_id = Auth::id();
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        // $media = Media::find($id);
        Media::where('url',$filename)->delete();
        $path=public_path().'../Media/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        // $media->delete();
        return $filename;  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::where('type',2)->get();
        // $category_child'] = Category::where('parent_id','id')->get();
        $data['category_add'] = Category::all();
        $data['lang'] = Lang::all();
        $data['tag'] = Tag::where('type',2)->get();
        $data['media']  = Media::where('type',1)->orderBy('id','desc')->get();
        $data['product'] = Product::find($id);
        // $data['product_media'] = ProductMedia::all();
        $data['product_img'] = Media::join('product','product.product_media_id', '=', 'media.id')
            ->where('product.id', $id)
            ->select('media.url')->first();
        // dd($id);
        $data['product_media'] = ProductMedia::join('product','product.id', '=', 'product_media.product_id')
            ->where('product.id', $id)
            ->select('product_media.media_id')->get();
        // dd($data['product_media']);
        
        $data['pro_media'] = ProductMedia::join('product','product.id', '=', 'product_media.product_id')
            ->join('media','media.id','=','product_media.media_id')
            ->where('product.id', $id)
            ->select('media.url','media.id')->get();
        $data['product_tag'] = ProductTag::join('product','product.id', '=', 'product_tag.product_id')
            ->where('product.id', $id)
            ->select('product_tag.tag_id')->get();

        $data['category_old'] = CategoryLink::join('product','product.id', '=', 'category_link.link_id')
            ->where('product.id', $id)->where('category_link.type','=',2)
            ->select('category_link.category_id')->get();

        return view('Admin.Product.edit',$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       //dd($request['short_content']);
      if($request->promotion_price){
        $this->validate($request,
        [
         
          'price'=>'required|numeric|max:10000000000|integer',
          'title'=>'required|max:255',
          'promotion_price'=>'numeric|greater_than_field:price|integer',
        ],
        [
         'promotion_price.greater_than_field'=>'Không được lớn hơn giá thực !!!',
         'price.integer'=>'Phải là số nguyên !!!',
         'promotion_price.integer'=>'Phải là số nguyên !!!',
         'price.required'=>'Không được trống !!!',
         'price.numeric'=>'Phải là số !!!',
         'price.max'=>'Không được lớn hơn 10.000.000.000 VND !!!',
         'promotion_price.numeric'=>'Phải là số !!!',
         'promotion_price.max'=>'Không được lớn hơn giá thực !!!',
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         'title.unique'=>'Tiêu đề đã tồn tại'
        ]);
      }elseif($request->price){
        $this->validate($request,
        [
          'price'=>'numeric|max:10000000000|integer',
          'title'=>'required|max:255',
        ],
        [
         'price.numeric'=>'Phải là số !!!',
         'price.integer'=>'Phải là số nguyên !!!',

         'price.max'=>'Không được lớn hơn 10.000.000.000 VND !!!',
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         'title.unique'=>'Tiêu đề đã tồn tại'
        ]);

      }elseif($request->price && $request->promotion_price){
        $this->validate($request,
        [
          'price'=>'numeric|max:10000000000|integer',
          'promotion_price'=>'numeric|greater_than_field:price|integer',
          'title'=>'required|max:255',
        ],
        [
         'price.numeric'=>'Phải là số !!!',
         'price.integer'=>'Phải là số nguyên !!!',
         'promotion_price.integer'=>'Phải là số nguyên !!!',
         'promotion_price.greater_than_field'=>'Không được lớn hơn giá thực !!!',
         'price.max'=>'Không được lớn hơn 10.000.000.000 VND !!!',
         'promotion_price.after_or_equal'=>'Không được lớn hơn giá thực !!!',
         'promotion_price.numeric'=>'Phải là số !!!',
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         'title.unique'=>'Tiêu đề đã tồn tại',
        ]);
      }else{
        $this->validate($request,
        [
          'title'=>'required|max:255',
        ],
        [
         'title.required'=>'Không được trống !!!',
         'title.max'=>'không được vượt quá 255 kí tự',
         'title.unique'=>'Tiêu đề đã tồn tại'
        ]);
      }
        
        $id = $request['id'];
        $data = $request->all();
        $product_id = Product::where('id',$id)->update(
            array(
            'title' =>$request['title'],
            'content'  => $request['content'],
            'principles'  => $request['principles'],
            'parameter'  => $request['parameter'],
            'short_content' =>$request['short_content'],
            'price'  => $request['price'],
            'lang_id'  => $request['lang'],
            'promotion_price'  => $request['promotion_price'],
            'user_id'  => Auth::id(),
            'slug' => Str::slug($request->title,'-'),
            'product_media_id' => $request['product_media_id'],
            'created_at' =>Carbon::now()
            )
        );
        CategoryLink::where('link_id', $id)->delete();
        ProductTag::where('product_id', $id)->delete();
        ProductMedia::where('product_id',$id)->delete();
        //add cate
        if($request['category'] != 0){
            $categorylist = $request['category'];
            foreach ($categorylist as $row) {
                $charges[] = [
                    'category_id' => $row,
                    'link_id' => $id,
                    'type' => 2,
                    'created_at' =>Carbon::now()
                ];
            }
            CategoryLink::insert($charges);
        }
        //add tag
        if($request['tag'] != 0){
            $tagList = $request['tag'];
            foreach ($tagList as $row) {
                $charges1[] = [
                    'tag_id' => $row,
                    'product_id' => $id,
                    'created_at' =>Carbon::now()
                ];
            }
            ProductTag::insert($charges1);
        }
        //add img
        if($request['media_id'] != 0){
            $cut = rtrim($request['media_id'],", ");
            // var_dump($cut);
            $mediaList = explode(",",$cut);  
            foreach ($mediaList as $row) {
                $charges2[] = [
                    'media_id' => $row,
                    'product_id' => $id,
                    'created_at' =>Carbon::now()
                ];
            }
            ProductMedia::insert($charges2);
        }
        Session::flash('success', 'cập nhật sản phẩm thành công'); 
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id',$request->id)->delete();

        $category_link = CategoryLink::where('link_id',$request->id)->delete();
        $product_tag = ProductTag::where('product_id',$request->id)->delete();
        $product_media = ProductMedia::where('product_id',$request->id)->delete();
        return redirect(route('index.product'))->with('success','Sản phẩm đã được xóa !');

    }


    public function search(Request $request)
    {
      if($request->ajax()){ 
        $output ='';
        $products = DB::table('product')->join('category_link','product.id','=','category_link.link_id')
                                ->join('category','category_link.category_id','=','category.id')
                                ->where('product.title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('short_content', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('content', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('price', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('promotion_price', 'LIKE', '%' . $request->search . '%')
                                ->leftJoin('media','product.product_media_id', '=', 'media.id')
                                ->select('product.*','media.url','category.name')
                                ->orderBy('product.id','desc')
                                ->paginate(10);
        if($products){
          $stt = 1;
    
          foreach ($products as $key => $product) {
            $output .= '<tr>
              <th><input type="checkbox"  name="check_all" class="checkbox" data-id='.$product->id.' ></th>
              <th>' . $stt++ . '</th>
              <th scope="col"><img src="'. asset("Media/". $product->url) . '" width="50px" height="50px"></th>
              <th>' . $product->title . '</th>
              <th>' . $product->name . '</th>
              <th>' . $product->price . ' đ</th>
              <th>' . $product->promotion_price . ' đ</th>            
              <th scope="col" class="tacvu"><a href='.route('edit.product',['id'=>$product->id]).'><i class="fa fa-edit tacvu"></i></a>
              <a onclick="deleteproduct(this,'.$product->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';
          }
        }
        $data['data'] = $output;
        $data['paganate'] = '<div class="row">'.$products->render().'</div>';
        return response($data);
      }
    }
    public function deleteImage(Request $request)
    {
        // dd($request->all());
        $id = $request['id'];
        if($filename = $request->input('id'))
        {
            $data = ProductMedia::where('id',$request->input('id'))->delete();
            $respon['message'] = "success";
            $respon['id'] = $id;

            // Session::flash('success', 'Ảnh đã được xóa');
            return response()->json($respon);
        }
    }
    //xoa tat ca cac truong
    public function delete_multiple_product(Request $request){
         $ids = $request->ids;

        Product::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['status'=>true,'message'=>"Xoá sản phẩm thành công"]);  
    }

}