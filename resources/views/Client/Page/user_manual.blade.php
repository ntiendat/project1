@extends('Client.Layouts.master')
@section('content-client')
<div class="container">
	<div class="right col-lg-3 " style="" >
		@foreach($allposts as $allpost)
		<div class=" box-image " >
			<div  class="image " >
				<a href="{{route('home.list.post',$allpost->id)}}" >
				<img width="300" height="152" src="{{asset('Media/'.$allpost->url)}}" >
				</a>
			</div>
			<div class="chu "  >
				<div >
					<a href="{{route('home.list.post',$allpost->id)}}">
						<h5>{{$allpost->title}}</h5>
					</a>
					<a href="{{route('home.list.post',$allpost->id)}}">
				<p class="from_the_blog_excerpt ">{!! substr($allpost->content,0,200) !!}[...] </p>
			</a>
				</div>
			</div>
		</div><br>
		@endforeach		
	</div>
	<div class="col-lg-9 ">
			<div>
				<span class="widget-title "><span>Bài viết mới nhất</span></span>
				@foreach($newposts as $newpost)
					<ul>
						<li class="recent-blog-posts-li">
							<div class="flex-col mr-half">
								<a href="{{route('home.list.post',$newpost->id)}}" >
									<img width="100" height="50" src="{{asset('Media/'.$newpost->url)}}" >
								</a>
							</div>
							<div class="flex-col flex-grow">
								<a href="{{route('home.list.post',$newpost->id)}}" class="bvietmoinhat" >{{$newpost->title}}</a>
								
							</div>
						</li>
					</ul>
				@endforeach
			</div>

			<div>
				<span class="widget-title "><span>Sản phẩm mới cập nhập</span></span>
				@foreach($newproducts as $newproduct)
					<ul>
						<li class="recent-blog-posts-li">
							<div class="flex-col mr-half">
								<a href="{{route('home.list.product',$newproduct->id)}}">
									<img width="100" height="50" src="{{asset('Media/'.$newproduct->url)}}" >
								</a>
							</div>
							<div class="flex-col flex-grow">
								<a href="{{route('home.list.product',$newproduct->id)}}" class="spmoinhat">{{$newproduct->title}}</a>
								
							</div>
						</li>
					</ul>
				@endforeach
			</div>
	</div>

</div>
<div class="row" >{{$allposts->links()}}</div>
@endsection

