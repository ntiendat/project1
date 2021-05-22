@extends('Client.Layouts.master')

@section('title-client') Chi tiết post  @endsection

@section('content-client')
<?php use App\Models\Comment; ?>
    <style>
        .error-message{
            color: red;
        }
        input,textarea{
            border: 1px solid;
        }
        .sidebar-page-container {
             padding: 0px !important; 
        }
    </style>
 <!--Page Title-->
    <section class="page-title" style="background-image: url(Media/anhbanner.jpg);">
        <div class="auto-container">
            <h1>{{$post->title}}</h1>
            <span class="title_divider"></span>
            <ul class="page-breadcrumb">
                <li><a href="{{route('home.index')}}">Home</a></li>
                <li>{{$post->title}}</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
    {{-- @include('sweetalert::alert') --}}
     <!-- Sidebar Page Container -->
    <div class="sidebar-page-container left-sidebar">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Sidebar Side-->
                {{-- @include('Client.Blog.sidebar-blog') --}}
                <!--Content Side-->
                <div class="content-side col-lg-12 col-md-12 col-sm-12">
                    <div class="blog-post hover-stop">
                        <!-- News Block -->
                        <div class="news-block">
                            <div class="inner-box">
                                <div class="lower-content">
                                    @foreach($form as $value)
                                        <?php
                                            $form1 =$value->name;
                                            if (strpos($post->content,$form1,0) > 0) {
                                                echo "<input type='hidden' value='".$value->email_to."' id='email_to'>";
                                                $post->content = str_replace($form1,$value->value,$post->content);
                                            }
                                        ?>
                                    @endforeach
                                    <?php  echo $post->content; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Sidebar Side-->
                {{-- @include('Client.Blog.sidebar-blog') --}}
            </div>
        </div>
    </div>
    <!-- End Sidebar Container -->
@endsection
@section('script-client')
    <script>
        $('#send_email').on('click',function(){
            var email_to = $('#email_to').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var phone = $('#phone').val();
            var message = $('#message').val();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('post.contact.page') }}",
                data:{name:name,
                    email:email,
                    address:address,
                    phone:phone,
                    message:message,
                    email_to:email_to
                },
                success:function (data) {
                    alert('Liên hệ đã được gửi !!!');
                    // console.log(data);
                    // $( "#name-label-"+data['id'] ).html( name );
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }); 
    </script>
@endsection
