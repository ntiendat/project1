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
use App\Models\Contact;
use App\Models\Form;
use App\Models\History;
use Carbon\Carbon;
use Auth;
use DB;
use App\Helper\Helper;
use Mail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;

class PostController extends Controller
{
	 use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	 public function getUsermanual(Request $request){
	 	return view('Client/Page/payment_goods');
	 }

	public function getAllpost(Request $request){
		$allposts = Post::join('media','post.media_id','=','media.id')->select('post.*','media.url')->orderBy('id','DESC')->paginate(5);
		// dd($allposts);
		$newposts = Post::join('media','post.media_id','=','media.id')->select('post.*','media.url')->orderBy('id','DESC')->limit(5)->get();
		$newproducts = Product::join('media','product.product_media_id','=','media.id')->select('product.*','media.url')->orderBy('id','DESC')->limit(5)->get();
		return view('Client.Page.user_manual',compact('allposts','newposts','newproducts'));
	}
	
	public function getDetailPost(Request $request, $id){

		$data['menuu'] = Category::where('type',1)->where('parent_id',$id)->get();
		
		
		$data['id']=$id;

		

		$data['post_related'] = Post::join('category_link','category_link.link_id','=','post.id')
							->where('category_link.type',1)
							->where('post.type',0)
							->where('post.id','<>',$id)
							->inRandomOrder()
							->limit(2)->get();
		$data['post'] = Post::orderBy('id','DESC')->limit(5)->get();
		// dd($data['post_related']);	
		$data['newposts']	=	Post::join('media','post.media_id','=','media.id')->select('post.*','media.url')->orderBy('id','DESC')->limit(5)->get();
		
		$data['newproducts']	=	Product::join('media','product.product_media_id','=','media.id')->select('product.*','media.url')->orderBy('id','DESC')->limit(5)->get();

		$data['post'] = Post::find($id);

		$data['form'] = Form::all();

		$data['menu'] =Menu::find($id);
		//l???y b??i vi???t theo tag
		$data['tags'] = TagLink::join('post','post.id','=','tag_link.post_id')
					->join('tag','tag.id','=','tag_link.link_id')
					->where('tag_link.post_id',$id)
					->select('tag.*','tag_link.*')
					->get();

		
		$data['comments'] = Comment::join('post','post.id','=','comment.link_id')
							->where('comment.link_id',$id)
							->where('comment.status',2)
							// ->where('post.allow_comment',1)
							->select('comment.*')
							->paginate(100);
		 
		//get log page
		$api_history = Helper::GetApi('https://www.iplocate.io/api/lookup/');

		$history_array = json_decode($api_history, true); //json_decode: chuyen doi chuoi json sang array
	
		$data['history'] = new History();
		$data['history']->link_id = $request->id;
		$data['history']->type = 1;
		$data['history']->location =$history_array['city'].','.$history_array['country'];
		$data['history']->ip = $history_array['ip'];
		$data['history']->save();

		//?????m s??? l?????ng ng?????i xem t???ng post
		$data['count_post'] = Post::find($id);

		if($data['count_post'] != null) {
			$data['count_post']->count += 1;
			$data['count_post']->save();
		}

		
		return view('Client.Blog.detail-blog',$data);
	}

	public function getDetailPage($id){
		$data['post'] = Post::find($id);
		$data['form'] = Form::all();
		$data['form1'] = Form::all();
		$data['menu'] =Menu::find($id);
		
		return view('Client.Blog.detail-page',$data);
	}
	
	public function postContactPage(Request $request){
	  	$mailto = $request['email_to'];
	  	$email = $request['email'];
		$data = [
			'name'  => $request['name'],
            'email'  => $request['email'],
            'address'  => $request['address'],
            'phone'  => $request['phone'],
            'content' => $request['message'],
        	'status' => 1,
            'created_at' =>Carbon::now()
		];
		DB::table('contact')->insert($data);
		Mail::send('Client.Email.email-contact',$data,function($message) use ($email,$mailto) {
			$message->from($email,'Ng?????i g???i');
			$message->to($mailto,'Ng?????i nh???n');
			$message->subject('Th??ng tin kh??ch h??ng li??n h???');
		});
        $respon['message'] = "success";
        $respon['status'] = true;
        $respon['data'] = $data;
        return response()->json($respon);
	}

	//list post
	public function getListPost(Request $request,$id){
		$data['list_post_with_tag'] = Post::join('tag_link','post.id','=','tag_link.post_id')
					->where('tag_link.link_id',$id)
					->get();
		// dd($data['list_post_with_tag']);
		return view('Client.Blog.list-blog',$data);
	}
	

	//subcriber
	public function postSubcriberPost(Request $request){
		$this->validate($request,
	      [
	        'email'=>'required|max:100',
	      ],
	      [
	       'email.required'=>'Kh??ng ???????c tr???ng !!!',
	       'email.max'=>'Nh???p t???i ??a 100 k?? t??? !!!',
	      ]);
		$subcriber = new Subscriber();
		$subcriber->email = $request->email;
		$subcriber->save();
		return redirect()->back()->with('success','???? ????ng k?? nh???n b???n tin');
	}
	//add comment
	public function postAddComment(Request $request){
		// if(Auth::check() == null){
		// 	return 0;
		// }else{
			$this->validate($request,
		      [
		        'email'=>'required|max:100|email',
		        'firstname'=>'required|max:255',
		        'lastname'=>'required|max:255',
		        'message'=>'required|max:500',
		      ],
		      [
		       'email.required'=>'X Email kh??ng ???????c ????? tr???ng',
		       'email.max'=>'X Email kh??ng ???????c qu?? 100 k?? t???',
		       'email.email'=>' x Ph???i l?? ?????nh d???ng c???a Email',
		       'firstname.required'=>'X H??? kh??ng ???????c ????? tr???ng',
		       'firstname.max'=>'X H??? t???i ??a 255 k?? t???',
		       'lastname.required'=>'X T??n kh??ng ???????c ????? tr???ng',
		       'lastname.max'=>' X T??n kh??ng ???????c qu?? 255 k?? t???',
		       'message.max'=>' X Nh???p t???i ??a 500 k?? t??? ',
		       'message.required'=>'X B??nh lu???n kh??ng ???????c ????? tr???ng',
		      ]);
			
			$data = $request->all();
	        $comment = DB::table('comment')->insert(
	            array(
	            'content'  => $request['message'],
	            'status'  => 1,
	            'type' => 1,
	            'title_comment'  => 'post_comment',
	            'link_id'  => $request['link_id'],
	            'lastname' => $request['lastname'],
            	'firstname' => $request['firstname'],
            	'email' => $request['email'],
	            // 'user_id'  => Auth::id(),
	            'created_at' =>Carbon::now()
	            )
	        );
	        //Session::flash('success','B??nh lu???n ???? ???????c ghi l???i');
	        $respon['message'] = "success";
	        $respon['status'] = true;
	        $respon['data'] = $data;
	        return response()->json($respon);
		// }
	}
}
