@extends('Client.Layouts.master')

@section('title-client') Danh sách bài viết  @endsection

@section('content-client')
<?php use App\Models\Comment; ?>
    <!--Page Title-->
    <section class="page-title" style="background-image: url(Media/anhbanner.jpg);">
        <div class="auto-container">
            <h1>Danh sách bài viết</h1>
            <span class="title_divider"></span>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home.index')}}">Home</a></li>
                <li>Danh sách bài viết</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container left-sidebar">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-sidebar hover-stop">
                        @foreach($list_post_with_tag as $list_post_with_tag)
                        <!-- News Block -->
                        <div class="news-block">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{route('home.list.post',$list_post_with_tag->post_id)}}">
                                        @if($list_post_with_tag->media_id != null)
                                            <img src="Media/{{$list_post_with_tag->Media->url}}" alt="">{{-- </a> --}}
                                        @else
                                            <img src="Media/post.jpg" alt="">
                                        @endif
                                    </a></figure>
                                    <a href="{{route('home.list.post',$list_post_with_tag->post_id)}}" class="date"><i class="far fa-calendar"></i>{{Carbon\Carbon::parse($list_post_with_tag->created_at)->format('d-m-Y')}}</a>
                                </div>
                                <div class="lower-content">
                                    <a href="{{route('home.list.post',$list_post_with_tag->post_id)}}" class="read-more"><i class="flaticon-right-arrow"></i></a>
                                    <h4><a href="{{route('home.list.post',$list_post_with_tag->post_id)}}">{{$list_post_with_tag->title}}</a></h4>
                                    <div class="text">{!! $list_post_with_tag->length_expect!!}</div>
                                    <div class="post-info">
                                        <div class="post-author">
                                           {{--  @if($list_post_with_tag->media_id != null)
                                                <img src="Media/{{$list_post_with_tag->Media->url}}" alt="">
                                            @else
                                                <img src="Media/post.jpg" alt="">
                                            @endif --}}
                                            <img src="HTML/Setech/images/resource/author-thumb.png" alt="" />
                                            {{$list_post_with_tag->User->firstname}} {{$list_post_with_tag->User->lastname}}
                                        </div>

                                        <div class="post-option">
                                            <div class="coments_count"><a href="{{route('home.list.post',$list_post_with_tag->post_id)}}"><i class="fa fa-comment"></i><?php $commentCount = Comment::commentCount($list_post_with_tag->post_id); echo $commentCount; ?></a></div>
                                            <ul class="social-share">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--Sidebar Side-->
                @include('Client.Blog.sidebar-blog')
            </div>
        </div>
    </div>
    <!-- End Sidebar Container -->
@endsection