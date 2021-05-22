@extends('Client.Layouts.master')

@section('title-client') Liên hệ  @endsection

<style type="text/css">
    .image-column{
        
        margin-top:-50px;
    }
     .auto-container{
        margin-left: 10px;
        margin-top:50px;
    }
    .page-breadcrumb{
        margin-left: 30px;
    }
    #submit{
            background-color: #f68121;
    }
    #submit a{
        color: white;
    }
</style>
@section('content-client')

<!--Page Title-->
   
    <!--End Page Title-->

    <!-- Contact Form Section -->
    <section class="container">
        <div class="auto-container">
            <div class="row form-outer">
                <!-- Image Column -->
                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                    <div class="layer-image" style="background-image: url(HTML/Setech/images/background/13.jpg);"></div>
                     <section class="page-title" style="background-image: url(HTML/Setech/images/background/12.jpg);">
                        <div class="auto-container">
                            <h3>Liên hệ</h3>
                            <span class="title_divider"></span>
                            <b>Công ty cổ phần XNK Xiaomi Việt Nam – Đại diện chính thức của Xiaomi tại Việt Nam</b>
                            <ul style="list-style-type: circle;color: black;" class="page-breadcrumb">
                               
                               
                                    <li><b>Trụ Sở:</b> 47 Tân Kỳ Tân Quý, P. Tân Sơn Nhì, Q. Tân Phú, HCM</li>
                                    <li><b>Chi nhánh 1:</b> 31 Nguyễn Tất Thành, P.13, Q.4, HCM</li>
                                    <li> <b>Điện thoại:</b> 028.627.22.135</li>
                                    <li><b>Hỗ trợ kỹ thuật (9h-21h):</b> 028 22 48 3377</li>
                                    <li><b> Email:</b> cskh@xiaomiviet.vn</li>
                                    <li><b>Website:</b> xiaomiviet.vn</li>
                            </ul>
                        </div>
                    </section>
                </div>

                <!-- Form Column -->
                <div class="form-column col-lg-4 col-md-12 col-sm-12">
                    <div class="default-form contact-form">
                        <div class="title">
                            
                            <p>Liên hệ tư vấn mua hàng</p>
                        </div>



                        <form class="outer-repeater needs-validation"  method="POST" enctype="multipart/form-data" novalidate  >
                            @csrf
                            <div class="row mid-spacing">
                                <div class="form-group mb-0 col-lg-12">
                                    <div class="response"></div>
                                </div>

                                <div class="form-group col-lg-12 col-md-6 col-sm-12">
                                    <input class="form-control" type="text" name="first_name" id="first_name" class="first_name" placeholder="First Name" required="">
                                    <div class="invalid-feedback"><em></em> <span class="title-message">Họ không được để trống </span></div>

                                </div>

                                <div class="form-group col-lg-12 col-md-6 col-sm-12">
                                    <input class="form-control" type="text" name="last_name" id="last_name" class="last_name" placeholder="Last Name" required>
                                    <div class="invalid-feedback"><em></em> <span class="title-message">Tên không được để trống </span></div>

                                </div>

                                <div class="form-group col-lg-12 col-md-6 col-sm-12">
                                    <input class="form-control" type="number" name="phone" id="phone"  placeholder="Phone" required>
                                    <div class="invalid-feedback"><em></em> <span class="title-message">Số điện thoại không được để trống </span></div>

                                </div>
                                
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="form-control" name="contact_message" id="contact_message" placeholder="Message" ></textarea>
                                    <div class="invalid-feedback"><em></em> <span class="title-message">Tiêu đề sản phẩm không được để trống </span></div>

                                </div>
                                
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button  type="submit" id="submit"  class="btn btn-success">Gửi liên hệ</button>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>

                <div class="col-lg-3 ">
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

            
        </div>
    </section>

    <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {

           
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {

                    event.preventDefault();
                    event.stopPropagation();

                    if (form.checkValidity() === true) {
                        save();
                    } 
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        })();

        function save(){
             var first_name =  $('#first_name').val();
             var last_name =  $('#last_name').val();
             var phone =  $('#phone').val();
             var contact_message =  $('#contact_message').val();

             $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
             $.ajax({
                type:'POST',
                url:"{{route('savecontact')}}",
                data:{
                      first_name:first_name,
                      last_name:last_name,
                      phone:phone,
                      contact_message:contact_message
                    },
                success:function(data){
                    alert('Liên hệ đã được gửi');
                   
                },
                error: function() {
                    
                }
             })

           return false;
        }

</script>

@endsection

