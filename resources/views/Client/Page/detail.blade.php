@extends('Client.Layouts.master')

@section('title-client')
    <title> {{ trans('mess.Home') }}</title>
@endsection

@section('content-client')
      
    <div id="site" class="position-relative" style="overflow: hidden">       
        <div id="content">
          <div class="container">
            <div class="box-bread">
              <div class="row">
                <div class="col-md-12">
                  <nav>
                    <ol class="breadcrumb" style="background-color: #f5f5f5">
                      <li class="breadcrumb-item">
                        <a href="{{route('home.index')}}">{{ trans('mess.Home') }}</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="">Product </a>
                      </li>
                      <li class="breadcrumb-item active">
                        <a href="">Iphone</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>

            <div class="box-detail">
              <div class="row">
                <div class="col-md-3">
                  <h5 class="cat-blog">Bài viết mới nhất</h5>
                  <ul class="list-blog">
                    @foreach ($detail as $dl)
                      <li class="blog-item d-flex py-2">
                        <div class="thumb-blog w-50">
                          <a href="">
                            <img
                              src="Media/{{$dl->url}}"
                              alt=""
                              class="img-fluid"
                            />
                          </a>
                        </div>
                        <div class="box-desc-blog px-3">
                          <p class="mb-0">
                            {{$dl->title}}
                          </p>
                        </div>
                      </li>  
                    @endforeach
                  </ul>
                </div>
                <div class="col-md-5">

                  <div id="show">
                    @foreach ($product as $pd)
                      @if ($pd->Media != null)
                        <img
                          class="img-fluid w-100"
                          src="Media/{{$pd->Media->url}}"
                          alt=""
                        />
                      @endif
                    @endforeach
                  </div>
                  
                  <div id="wp-list-thumb">
                    <ul id="list-thumb " class="d-flex mt-2">
                      @foreach ($product_image as $product_image)
                        <li class="thumb-item">
                          <a class="d-block active-thumb" href="">
                            <img class="img-fluid" src="Media/{{ $product_image->url}}" alt="" />
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>   
                         
                  </div>
                     

                <div class="col-md-4">
                  <div class="info-product">
                    @foreach ($product as $pd)
                         <p class="name-product">
                         {{$pd->title}}
                        </p>
                        <div>
                          <strong class="desc-product">
                            {!!$pd->content!!}
                          </strong> 
                        </div>
                    @endforeach
                    
                  </div>
                  <div class="buy-product mt-3">
                    <a href="" class="buy-now btn btn-block" data-toggle="modal"
                      data-target="#buy-now-modal">
                        Mua ngay
                    </a>
                    <a href="" class="add-cart btn btn-block">Thêm vào giỏ</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="box-tabs">
              <nav>
                <div class="nav nav-tabs">
                  <a
                    href="#tab-1"
                    class="nav-item nav-link active"
                    data-toggle="tab"
                    >Mô tả</a
                  >
                  <a href="#tab-2" class="nav-item nav-link" data-toggle="tab"
                    >Thông tin liên hệ
                  </a>

               
                </div>
              </nav>
              <!-- 2 nội dung  -->
              <div class="tab-content" id="tab-home">
                <div class="tab-pane show fade active" id="tab-1">
                  <p>
                    @foreach ($product as $pd)
                        {!!$pd->content!!}
                    @endforeach
                  </p>
                  <div class="btn-buy-now text-center mt-3 mb-5">
                    <a
                      href=""
                      class="btn"
                      data-toggle="modal"
                      data-target="#buy-now-modal"
                      >Mua ngay</a
                    >
                  </div>
                </div>
                <div class="tab-pane show fade" id="tab-2">
                  <strong class="d-block py-3">Xiaomiviet.vn</strong>
                  <p>
                    Trụ Sở:<span
                      >47 Tân Kỳ Tân Quý, P. Tân Sơn Nhì, Q. Tân Phú, HCM – (Gần
                      ngã tư Trường Chinh và Tân Kỳ Tân Quý).</span
                    >
                  </p>
                  <p>
                    Chi nhánh:<span>
                      31 Nguyễn Tất Thành, P.13, Q.4, HCM – (Gần Nguyễn Huệ Quận
                      1).</span
                    >
                  </p>
                  <p>Điện thoại:<span> 1900.888.867</span></p>
                  <p>Email:<span> cskh@xiaomiviet.vn</span></p>
                  <div class="btn-buy-now text-center mt-3 mb-5">
                    <a
                      href=""
                      class="btn"
                      data-toggle="modal"
                      data-target="#buy-now-modal"
                      >Mua ngay</a
                    >
                  </div>
                </div>
              </div>
            </div>
            
            <div class="related-products">
              <div class="title">
                  <h3>Sản phẩm liên quan</h3>
              </div>
                  <div class="three-items-carousel owl-carousel owl-theme disable-arrow default-dots">
                    
                  @foreach($related as $related)
                      <!-- Shop Item --> 
                      <div id="show"  class="image-box">
                        {{-- {{dd($related)}} --}}
                        <div  class="shop-item">
                          <div class="inner-box">
                                  <figure  class="image">
                                    <a  href="{{route('post.detail',$related->id)}}">
                                      @if($related->product_media_id != null)
                                          <img src="Media/{{$related->Media->url}}" alt="">
                                      @else
                                          <img src="Media/image_product.jpg" alt="">
                                      @endif
                                      
                                    </a>
                                  </figure>
                                  
                              </div>
                              <div class="lower-content">
                                  <h4 class="name"><a href="{{route('post.detail',$related->id)}}">{{$related->title}}</a></h4>
                                  <div class="price">
                                      @if($related->promotion_price != 0)
                                          {{number_format($related->promotion_price)}} <sup>đ</sup>
                                          <del>{{number_format($related->price)}} </del> <sup>đ</sup>
                                      @else
                                          {{number_format($related->price)}} <sup>đ</sup>
                                      @endif
                                  </div>
                                   <button type="button" class="theme-btn add-cart" data-id="{{$related->id}}"><span class="btn-title">Thêm giỏ hàng</span></button>
                              </div>
                          </div>
                      </div>
                  @endforeach
                  </div>
              </div>
          </div>

            <!-- ========================modal===================================== -->
            <div class="modal" id="buy-now-modal">
              <!-- thêm modal-dialog-scrollable để thêm thanh cuộn  -->
              <!-- thêm modal-dialog-centered để căn giữa -->
              <!-- sử dụng modal-sm modal-xl để điều chỉnh kích thước modal  -->
              <div
                class="modal-dialog modal-dialog-scrollable modal-dialog-centered"
              >
                <div class="modal-content">
                  <div class="modal-header">
                    <!-- <h5>Demo modal</h5> -->
                    <p>
                      ĐẶT MUA
                      @foreach ($product as $item)
                        <span class="name-product-by mb-0">
                          {{$item->title}}
                        </span>
                      @endforeach

                    </p>
                    <button class="close-modal" data-dismiss="modal">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- end modal header  -->
                  <div class="modal-body">
                    <!-- sử dụng grid trong modal  -->
                    <div class="cotainer-fluid">
                      <div class="row">
                        <div class="col-md-6">
                          <div  class="box-info-product-buy d-flex">
                            <img
                              src="Media/{{$item->url}}"
                              alt=""
                              class="img-fluid"
                              style="width: 30%"
                            />
                            <div class="box-price">
                              <p class="name">
                                {{$item->title}}
                              </p>
                              <span class="price"> {{$item->price}}Đ </span>
                            </div>
                          </div>
                          <div class="form-quantity">
                            <form action="">
                              <label class="font-weight-bold" for="quantity"
                                >Số lượng</label
                              >
                              <input class="w-25" type="number" 
                               name="quantity"  id="quantity" />
                            </form>
                          </div>

                          <p class="note">
                            Bạn vui lòng nhập đúng số điện thoại để chúng tôi sẽ
                            gọi xác nhận đơn hàng trước khi giao hàng. Xin cảm
                            ơn!
                          </p>
                        </div>
                        <div class="col-md-6">
                          <p class="info-user">Thông tin người mua</p>
                          <form action=""   method="post" enctype="multipart/form-data" > 

                            <div class="name-phone d-flex mb-2">
                              <input class="w-50 mr-2" type="text" id="fullname" 
                              name="fullname" placeholder="Họ và tên"/>

                              <input class="w-50" type="number" id="phone" name="phone"
                                placeholder="Số điện thoại" />
                            </div>

                            <input class="w-100 mb-2" type="email"
                              name="email" id="email" placeholder="Email(Không bắt buộc)" />

                            <textarea  class="w-100"  id="diachi" cols="30" name="diachi"
                              rows="2"  placeholder="Địa chỉ" ></textarea>

                            <textarea  class="w-100" name="" id="ghichu" cols="30"
                              rows="2"  placeholder="Ghi chú đơn hàng (Không bắt buộc )"></textarea>
                            @foreach ($product as $item)
                              <p>Tổng: <span class="price">{{$item->price}}</span></p>
                            @endforeach
                            <button id="dathang" type="button" class="btn-buy btn btn-block">
                              ĐẶT HÀNG NGAY
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>

        <!-- ================================thêm vào giỏ hàng =============================== -->
        <div class="wp-on-cart position-absolute h-100">
          <div class="head-cart">
            <a href="" class="icon-close-cart d-block">
              <i class="fas fa-times"></i>
            </a>

            <p class="text-center">GIỎ HÀNG</p>

          </div>
          <div class="body-cart">

            <ul class="list-pro-on-cart">

              @foreach ($product as $item)
                <li class="pro-item-on-cart d-flex px-2 pb-3">
                  <img class="img-fluid w-25" src="Media/{{$item->url}}" alt="" />

                  <div class="name-product-on-cart">
                    <a href="" class="d-block">
                     {{$item->title}}
                    </a>
                    
                    <span class="text-muted">
                      <small class="text-danger">
                        {{$item->price}}
                      </small>
                    </span>

                    </div>

                      <a href="" class="icon-remove-cart d-block text-muted">
                        <i class="fas fa-times"></i>
                      </a>

                </li>
              @endforeach
              

              
            </ul>
                  <strong class="text-center d-block">
                    Tổng số tiền :
                    <span class="text-danger"> 17.940.000₫</span>
                  </strong>
          </div>

          <div class="footer-cart">
            <a href="" class="view-cart btn btn-block">Xem giỏ hàng</a>
            <a href="" class="checkout btn btn-block">Thanh toán</a>
          </div>

        </div>
        
    </div>
    <script>
    
      $("#dathang").click(function(){
        var fullname = $('#fullname').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var diachi = $('#diachi').val();
        var ghichu = $("#ghichu").val();
        $.ajax({
            url:"{{route('customer.order')}}",
            method:"POST",
            data:{
              "_token": "{{ csrf_token() }}",
              fullname:fullname,
              phone:phone,
              email:email,
              diachi:diachi,
              ghichu:ghichu,
            },

            success:function(data)
            {
              alert('Thêm Mới Thành Công');
              location.reload();
            },
            error: function(response) {
                
           }

        });
      });
    </script>
@endsection


