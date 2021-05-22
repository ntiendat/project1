<!--Sidebar Side-->
                <div class="sidebar-side sticky-container col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar theiaStickySidebar">
                        <div class="sticky-sidebar">
                            <!-- Category Widget-->
                            <div class="sidebar-widget category-widget">
                                <div class="sidebar-title"><h3>Danh mục sản phẩm</h3></div>
                                <div class="widget-content">
                                    <ul class="cat-list">
                                        @foreach($lists_category as $lists_category)
                                            <li><a href="{{route('get.list.product',$lists_category->id)}}">{{$lists_category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>                                
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
                                </div>
                            </div>
                        <!-- Cart Widget -->
                            <div class="sidebar-widget cart-widget">
                                <div class="widget-content">
                                    <div class="sidebar-title"><h3>Giỏ hàng của bạn </h3></div>                                    
                                    <div class="shopping-cart">
                                        @if(Session('cart'))
                                        <ul class="shopping-cart-items">
                                            @foreach($product_cart as $product)
                                                <li class="cart-item">
                                                    @if($product['item']['product_media_id'] != 0)
                                                        <img src="Media/{{$product['item']->Media->url}}" alt="" class="thumb">
                                                    @else
                                                        <img src="Media/noimage.png" alt="" class="thumb">
                                                    @endif
                                                    <span class="item-name">{{ $product['item']['title']}}</span>
                                                    <span class="item-quantity"> {{$product['qty']}} x <span class="item-amount">@if($product['item']['promotion_price'] ==0)
                                                        <?php $price = $product['item']['price']*$product['qty'];   ?>  
                                                    @else 
                                                       <?php $price = $product['item']['promotion_price']*$product['qty'];  ?> 
                                                    @endif
                                                    <label id="total-qty-{{$product['item']['id']}}">{{$price}}</label><sup>đ</sup>
                                                    </span></span>
                                                    <a href="{{route('home.list.product',$product['item']['id'])}}" class="product-detail"></a>
                                                    <button class="remove-item"><span class="flaticon-multiply"></span></button>
                                                </li>
                                            @endforeach
                                            
                                        </ul>
                                        <div class="cart-footer">
                                            <div class="shopping-cart-total"><span>Tổng tiền:</span> {{Session('cart')->totalPrice}} <sup>đ</sup>
                                             </div>
                                            <div class="btn-box">

                                                <a href="{{route('shopping.cart')}}" class="theme-btn">Xem giỏ hàng</a>
                                                <a href="{{route('get.checkout')}}" class="theme-btn">Thanh toán</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div> <!--end shopping-cart -->
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>