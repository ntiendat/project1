<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryLink;
use App\Models\Subscriber;
use App\Models\TagLink;
use App\Models\Slide;
use Carbon\Carbon;
use Auth;
use DB;
// use Session;

class HomeController extends Controller
{
	public function changeLanguage($language)
{
    \Session::put('website_language', $language);
	

    return redirect()->back();
}
	public function index(){
		
		if(config('app.locale')=='vi'){
        
		$category = DB::table('category')->where('displayed',1)->orderBy('order','asc')->limit(16)->pluck('id');
		//dd($category);
	   $product = array();
	   $product2 = array();
	   foreach ($category as $key => $value) {
		   $pd = array();
		   
		   array_push($pd,Category::where('id',$value)->first());
		   array_push($pd,Product::whereIn('id',DB::table('category_link')
		   ->where('type','=',2)
		   ->Where('category_id','=',$value)
		   ->pluck('link_id'))->get());
		   
		   
		   array_push($product,$pd);
	   }

	   $product_counts = Product::orderBy('count','desc')->get();
	   $slide = Slide::get();
	   array_push($product2,Category::first());
	   array_push($product2,	$product_counts);
	   // dd($product);
	   $khtb = Post::join('category_link','post.id','=','category_link.link_id')
			   ->where('category_link.type',1)
			   ->where('category_link.category_id',62)
			   ->select('post.*')->get();
	   
	   return view('Client.Page.index',compact('product','slide','product2','khtb'));}
          else{
           
		$category = DB::table('category')->where('displayed',1)->orderBy('order','asc')->limit(16)->pluck('id');
		//dd($category);
	   $product = array();
	   $product2 = array();
	   foreach ($category as $key => $value) {
		   $pd = array();
		   
		   array_push($pd,Category::where('id',$value)->first());
		   array_push($pd,Product::whereIn('id',DB::table('category_link')
		   ->where('type','=',2)
		   ->Where('category_id','=',$value)
		   ->pluck('link_id'))->get());
		   
		   
		   array_push($product,$pd);
	   }

	   $product_counts = Product::orderBy('count','desc')->get();
	   $slide = Slide::get();
	   array_push($product2,Category::first());
	   array_push($product2,	$product_counts);
	   // dd($product);
	   $khtb = Post::join('category_link','post.id','=','category_link.link_id')
			   ->where('category_link.type',1)
			   ->where('category_link.category_id',62)
			   ->select('post.*')->get();
	   
	   return view('Client.Page.index_en',compact('product','slide','product2','khtb'));
          }


	}
	


	public function getListUrl($id){
		$data['menu'] =Menu::find($id);
		return view('Client.Blog.detail-blog',$data);
	}
}