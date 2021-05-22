<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Media;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use App\Models\TagLink;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Company;
use App\Models\GroupTag;
use App\Models\Cart;
use App\Models\Lang;
use App\Models\Product;
use App\Models\Slide;
use Auth;
use Validator;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('Client/Layouts/category',function($view){
          $data['category'] = Category::all();
          //dd($data['category']);
          $view->with($data);
        });
        view()->composer('Client/Layouts/footer',function($view){
          $data['group']= GroupTag::all();
          $data['category'] = Category::where('displayed',1)->get();
          $data['tag'] = Tag::all();
          // $data['tag'] = $data['tag']->chunk('tag_group');
          $view->with($data);
        });


        
        view()->composer('Admin/right-col-edit',function($view){
            $data['category'] = Category::all();
            $data['lang'] = Lang::all();
            $data['category_add'] = Category::all();
            $data['media']  = Media::where('type',1)->orderBy('id','desc')->get();
            $view->with($data);
        });
        view()->composer('layouts/topbar',function($view){
            if('users.avatar' != null){
                $data['profile'] = Media::join('users','users.avatar','=','media.id')->where('users.id',Auth::user()->id)->select('media.url')->first();
                $view->with($data);
            }
        });
        view()->composer('layouts/sidebar',function($view){
           $data['profile'] = Media::join('users','users.avatar','=','media.id')->where('users.id',Auth::user()->id)->select('media.url')->first();
           $view->with($data);
        });
        // validate price
        Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
          $min_field = $parameters[0];
          $data = $validator->getData();
          $min_value = $data[$min_field];
          return $value < $min_value;
        });   

        Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
          return str_replace(':field', $parameters[0], $message);
        });

        //view menu client
        view()->composer('Client/Layouts/header',function($view){
          if(config('app.locale')=='vi'){
            $data['menu'] = Menu::where('master_menu_id',12)->get();}
          else{
            $data['menu'] = Menu::where('master_menu_id',13)->get();
          }
            $view->with($data);
        });
        view()->composer('Client/Shop/shop',function($view){
          // $data['menu'] = Menu::all();
          $lang_id= Lang::where('lang',config('app.locale'))->first();
          // dd($lang_id);
          $data['menu'] = Category::where('type',2)->where('lang_id',$lang_id->id)->get();
          $view->with($data);
      });
        view()->composer('Client/Shop/detail-shop',function($view){
          $data['menu'] = Category::where('type',2)->get();
          $view->with($data);
      });
        view()->composer('Client/Blog/list-blog-category',function($view){
          $data['menu'] = Category::where('type',1)->get();
          $view->with($data);
      });
        view()->composer('Client.Blog.detail-blog',function($view){
          $data['menu'] = Category::where('type',1)->get();
          $view->with($data);
      });
        view()->composer('Client/Shop/list_products',function($view){
            $data['menu2'] = Menu::all();
            $view->with($data);
        });

        //view menu client
        view()->composer('Client/Layouts/slider',function($view){
            $data['slide'] = Slide::get();
            $view->with($data);
        });


        //view image 
        view()->composer('Admin/modal-image',function($view){
            $data['media'] = Media::where('type',1)->orderBy('id','desc')->paginate(15);
            $view->with($data);
        });

        view()->composer('Client/Contact/contact',function($view){
           $data['newposts'] = Post::join('media','post.media_id','=','media.id')->select('post.*','media.url')->orderBy('id','DESC')->limit(5)->get();
           $data['newproducts'] = Product::join('media','product.product_media_id','=','media.id')->select('product.*','media.url')->orderBy('id','DESC')->limit(5)->get();
            $view->with($data);
        });
        //list tag
        view()->composer('Client/Blog/sidebar-blog',function($view){
           $data['lists_tag'] = Tag::where('type',1)->limit(10)
                    ->get();
           //post recent         
           $data['post_laster'] = Post::where('type',0)->orderBy('id','desc')->limit(3)->get();
            $view->with($data);
        });
        view()->composer('Client/Shop/sidebar-shop',function($view){
           $data['lists_category'] = Category::where('type',2)->limit(10)->get();
           //post recent 
           $data['post_laster'] = Post::where('type',0)->orderBy('id','desc')->limit(3)->get();
            $view->with($data);
        });
        view()->composer('Client/Layouts/header',function($view){
           $data['company'] = Company::all();
           $data['slide'] = Slide::get();
           $data['tag'] = Tag::all();
            $view->with($data);
        });
        
        //show giỏ hàng
        view()->composer(['Client/Layouts/header','Client/Shop/checkout','Client.Shop.shopping-cart','Client/Shop/detail-shop','Client/Shop/sidebar-shop','Client/Email/mail_order_success'],function($view){
          if(Session('cart')){
            $oldCart =Session::get('cart');//laay gio hang cua minh va gan vao gio cu~
            $cart = new Cart($oldCart);
            $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
          }
        });

        view()->composer('Client/Shop/sidebar-shop',function($view){
          $data['company'] = Company::all();
          $view->with($data);
        });
    }
}