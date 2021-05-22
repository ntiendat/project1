<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function penddingIndex()
    {

        $comments = Comment::join('post','post.id','=','comment.link_id')->where('comment.type',1)->select('comment.*')
            ->orderBy('status','asc')
            ->select('comment.*','post.title')
            ->paginate(10);
       
        return view('Admin.Comment.comment_index_post',compact('comments'));

    }


    public function successIndex()
    {
         $comments = Comment::join('post','post.id','=','comment.post_id')->select('post.title','comment.*')
            ->where('status',2)
            ->paginate(10);
        return view('Admin.Comment.success_index',compact('comments'));
    }


    public function successComment($id)
    {
        $comments =Comment::find($id);
        $comments->status = 2;
        $comments->save();
        return redirect()->back()->with('success','Bình luận đã được duyệt !!!');
    }


    //product
    public function penddingCommentProductIndex()
    {
        $comments = Comment::leftJoin('product','product.id','=','comment.link_id')
                            ->where('comment.type',2)
                            ->select('comment.*','product.title')
                            ->orderBy('status','asc')
                            ->paginate(10);

        //dd($comments);

        return view('Admin.Comment.comment_index_product',compact('comments'));
    }


     public function successCommentProductIndex()
    {
         $comments = Comment::join('product','product.id','=','comment.product_id')->where('status',2)
         ->select('product.title','comment.*')
         ->paginate(10);
        return view('Admin.Comment.success_index_product',compact('comments'));
    }

    public function deleteComment(Request $request)
    {
        $comments =Comment::where('id',$request->id)->delete();
        // return redirect()->back()->with('danger','Bình luận đã được xóa !!!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    //  public function delete_multiple_Comment_susscess(Request $request){
    //     $ids = $request->ids;
    //     Comment::whereIn('id',explode(",",$ids))->where('status',2)->delete();
    //     return response()->json(['status'=>true,'message'=>"xoá sản phẩm thành công"]);  
    // }

    public function delete_multiple_Comment_pendding(Request $request){
        $ids = $request->ids;
        Comment::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"xoá bình luận thành công"]);  
    }
    public function searchCommentproduct(Request $request){
        $output = '';
        $search = $request->search;
        // if(isset($request->status)){
        //   $status = $request->status;
        //   if($status != 0){
        //   }
        // }
        $comments = Comment::leftJoin('product','product.id','=','comment.link_id')
                            ->select('comment.*','product.title')
                             ->where(function($query) use ($search) {
                                  $query->where('title_comment', 'LIKE', '%' . $search . '%')
                                  ->orWhere('comment.content', 'LIKE', '%' . $search . '%')
                                  ->orWhere('product.title', 'LIKE', '%' . $search . '%');
                              })
                            ->Where('comment.type',2)
                            ->paginate(10);
          // dd($comments);
          $stt = 1;
          foreach ($comments as $key => $comment) {
            //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
            $option1 = '';
            $option2 = '';
            switch ($comment->status) {
              case 1:
                # code...
                $option1 = 'selected';
                break;
              case 2:
                # code...
                $option2 = 'selected';
                break;
              
              default:
                # code...
                break;
            }
            $output .= '<tr>
              <th><input type="checkbox" class="checkbox" data-id='.$comment->id.'></th>
              <th>' . $stt++ . '</th>
              <th>' . $comment->title_comment .  '</th>
              <th>' . $comment->content . '</th> 
              <th>' . $comment->member_rate . '</th> 
              <th>' . $comment->title . '</th> 
              <th>
                <select name="status-contact" class="form-control optionstatus" data-id='.$comment->id.'>
                  <option value="0">--</option>
                  <option value="1" '. $option1 .'>Chờ duyệt</option>
                  <option value="2" '. $option2 .'>Duyệt</option>
                </select>
              </th>

              <th scope="col" class="tacvu">
                <a onclick="deletecommentproduct(this,'.$comment->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';

          }
          $data['data'] = $output;
          $data['paging'] = '<div class="row">'.$comments->render().'</div>';
          return response($data);
    }

    public function searchCommentpost(Request $request){
        $output = '';
        $search = $request->search;
        $comments = Comment::join('post','post.id','=','comment.link_id')
                            ->select('comment.*','post.title')
                             ->where(function($query) use ($search) {
                                  $query->where('title_comment', 'LIKE', '%' . $search . '%')
                                  ->orWhere('comment.content', 'LIKE', '%' . $search . '%')
                                  ->orWhere('post.title', 'LIKE', '%' . $search . '%');
                              })
                            ->Where('comment.type',1)
                            ->paginate(10);
          // dd($comments);
          $stt = 1;
          foreach ($comments as $key => $comment) {
            //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
            $option1 = '';
            $option2 = '';
            switch ($comment->status) {
              case 1:
                # code...
                $option1 = 'selected';
                break;
              case 2:
                # code...
                $option2 = 'selected';
                break;
              
              default:
                # code...
                break;
            }
            $output .= '<tr>
              <th><input type="checkbox" class="checkbox" data-id='.$comment->id.'></th>
              <th>' . $stt++ . '</th>
              <th>' . $comment->title_comment .  '</th>
              <th>' . $comment->content . '</th> 
              <th>' . $comment->title . '</th> 
              <th>
                <select name="status-contact" class="form-control optionstatus" data-id='.$comment->id.'>
                  <option value="0">--</option>
                  <option value="1" '. $option1 .'>Chờ duyệt</option>
                  <option value="2" '. $option2 .'>Duyệt</option>
                </select>
              </th>

              <th scope="col" class="tacvu">
                <a href="#" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';

          }
          $data['data'] = $output;
          $data['paging'] = '<div class="row">'.$comments->render().'</div>';
          return response($data);
    }

    public function listComment(Request $request){
        $output = '';
        $comments = Comment::leftJoin('product','product.id','=','comment.link_id')
                            ->where('status','=',$request->status)
                            ->where('type',2)
                            ->orderBy('status','asc')
                            ->select('comment.*','product.title')
                            ->paginate(10);
        // dd($comments);
          $stt = 1;
          foreach ($comments as $key => $comment) {
            //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
            $option1 = '';
            $option2 = '';
            switch ($comment->status) {
              case 1:
                # code...
                $option1 = 'selected';
                break;
              case 2:
                # code...
                $option2 = 'selected';
                break;
              
              default:
                # code...
                break;
            }
            $output .= '<tr>
              <th><input type="checkbox" class="checkbox" data-id='.$comment->id.'></th>
              <th>' . $stt++ . '</th>
              <th>' . $comment->title_comment .  '</th>
              <th>' . $comment->content . '</th> 
              <th>' . $comment->member_rate . '</th> 
              <th>' . $comment->title . '</th> 
              <th>
                <select name="status-contact" class="form-control optionstatus" data-id='.$comment->id.'>
                  <option value="0">--</option>
                  <option value="1" '. $option1 .'>Chờ duyệt</option>
                  <option value="2" '. $option2 .'>Duyệt</option>
                </select>
              </th>

              <th scope="col" class="tacvu">
                <a onclick="deletecommentproduct(this,'.$comment->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';

          }
          $data['data'] = $output;
          $data['paging'] = '<div class="row">'.$comments->render().'</div>';
          return response($data);


    }

    public function listCommentPost(Request $request){
        $output = '';
        $comments = Comment::join('post','post.id','=','comment.link_id')
                            ->where('status','=',$request->status)
                            ->where('comment.type',1)
                            ->orderBy('status','asc')
                            ->select('comment.*','post.title')
                            ->paginate(10);
         
          $stt = 1;
          foreach ($comments as $key => $comment) {
            //$status = $contact->status=1 ? "chưa xử lý" : "đã xử lý";
            $option1 = '';
            $option2 = '';
            switch ($comment->status) {
              case 1:
                # code...
                $option1 = 'selected';
                break;
              case 2:
                # code...
                $option2 = 'selected';
                break;
              
              default:
                # code...
                break;
            }
            $output .= '<tr>
              <th><input type="checkbox" class="checkbox" data-id='.$comment->id.'></th>
              <th>' . $stt++ . '</th>
              <th>' . $comment->title_comment .  '</th>
              <th>' . $comment->content . '</th> 
             
              <th class="w30">  '.$comment->title.' </th> 
              <th>
                <select name="status-contact" class="form-control optionstatus" data-id='.$comment->id.'>
                  <option value="0">--</option>
                  <option value="1" '. $option1 .'>Chờ duyệt</option>
                  <option value="2" '. $option2 .'>Duyệt</option>
                </select>
              </th>

              <th scope="col" class="tacvu">
                <a onclick="deletecommentproduct(this,'.$comment->id.')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>';

          }
          $data['data'] = $output;
          $data['paging'] = '<div class="row">'.$comments->render().'</div>';
          return response($data);

    }

    public function updateStasusComment(Request $request) {

        $comments = comment::find($request->id);
        $comments ->status = $request->status;
        $comments ->updated_at = Carbon::now('+7:00');
        $comments ->save();

        $response['message']  = 'Update status success';
        return response($response);

    }


    public function updateStasusCommentPost(Request $request) {

        $comments = comment::find($request->id);
        $comments ->status = $request->status;
        $comments ->updated_at = Carbon::now('+7:00');
        $comments ->save();

         $response['message']  = 'Update status success';
        return response($comments);

    }

}
