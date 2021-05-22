 <div class="sidebar-side sticky-container col-lg-4 col-md-12 col-sm-12">
    <aside class="sidebar theiaStickySidebar">
        <div class="sticky-sidebar">

            <!--search box-->
            <div class="sidebar-widget search-box">
                <form method="post" action="blog-sidebar.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Search" required="">
                        <button type="submit"><span class="icon fa fa-search"></span></button>
                    </div>
                </form>
            </div>

            <!-- Newslatters-->
            <div class="sidebar-widget newslatters">
                <div class="sidebar-title"><h3><span class="icon flaticon-rss-symbol"></span>Bản tin</h3></div>
                <div class="text">Nhập địa chỉ email ở đây để nhận bản tin của chúng tôi</div>
                <form method="post" action="{{route('post.subcriber.post')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="email" id="email" value="" placeholder="Nhập email..." required="">
                        <button type="submit" class="subcriber-btn"><span class="btn-title">Đăng kí</span></button>
                    </div>
                </form>
            </div>

            <!-- Latest News -->
            <div class="sidebar-widget latest-news">
                <div class="sidebar-title"><h3>Bài viết gần đây</h3></div>
                <div class="widget-content">
                    @foreach($post_laster as $post_laster)
                    <article class="post">
                        <figure class="thumb">
                            @if($post_laster->media_id != null)
                                <img src="Media/{{$post_laster->Media->url}}" alt="">
                            @else
                                <img src="Media/post.jpg" alt="">
                            @endif
                        </figure>
                        <h5>{{$post_laster->title}}</h5>
                        <div class="post-info">{{Carbon\Carbon::parse($post_laster->created_at)->format('d-m-Y')}}</div>
                        <a href="{{route('home.list.post',$post_laster->id)}}" class="overlay-link"></a>
                    </article>
                    @endforeach
                {{--     <article class="post">
                        <figure class="thumb"><img src="images/resource/post-thumb-2.jpg" alt=""></figure>
                        <h5>One call for IT</h5>
                        <div class="post-info">Sep 09 2020</div>
                        <a href="blog-single.html" class="overlay-link"></a>
                    </article>

                    <article class="post">
                        <figure class="thumb"><img src="images/resource/post-thumb-3.jpg" alt=""></figure>
                        <h5>Monroe county</h5>
                        <div class="post-info">Sep 09 2020</div>
                        <a href="blog-single.html" class="overlay-link"></a>
                    </article> --}}
                </div>
            </div>

            <!-- Tags -->
            <div class="sidebar-widgets">
                <div class="widget-content">
                    <div class="banner-box-one" style="background: url(HTML/Setech/images/resource/banner-bg-1.png);">
                        <div class="content">
                            <h5 class="title">Ad Spot</h5>
                            <p>Facing challenges in the work process is very</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Tags -->
            <div class="sidebar-widget tags">
                <div class="sidebar-title"><h3>Tags</h3></div>
                <ul class="tag-list clearfix">
                    @foreach($lists_tag as $lists_tag)
                        <li><a href="{{route('get.list.post',['id'=>$lists_tag->id])}}">{{$lists_tag->name}}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>
    </aside>
</div>