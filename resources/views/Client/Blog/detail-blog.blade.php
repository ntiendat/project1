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
        .content-side{
            margin-left: 80px;
        }
        .auto-container{
            margin-top: 40px;
        }
    </style>
 <!--Page Title-->
    
    <!--End Page Title-->
    {{-- @include('sweetalert::alert') --}}
     <!-- Sidebar Page Container -->
    


   
     <div class="breadcrumb-edit">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="bread">
                        <li><a href="http://namhoang.com.vn/">{{ trans('mess.Home') }}</a></li>
                        <li><a href="http://namhoang.com.vn/san-pham">Tin tức</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        <!--End Page Title-->
        <!-- Sidebar Page Container -->
      
        <div class="container body-page-detail">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="menu_doc">
                        <div class="title_menu_doc">
                            <p>Tin Tức</p>
                        </div>
                        <div class="menuvertical">
                  

                            <ul class="menuvertical" id="dropdown">
    
                                <?php
                                   
                                 
                            if(count($menuu)==0){
                                if (isset($post)) {
                                    if(!is_array($post)){
                                       
                                    echo "<li><a class='d-block' href='".route('home.list.post',['id'=>$post->id])."' id='view_category_post_".$post->id."'><span>".$post->title."</span></a>";
                                    }
                                    else {
                                        foreach ($post as $key => $val) {
                                                 echo "<li><a class='d-block' href='".route('home.list.post',['id'=>$val->id])."' id='view_category_post_".$val->id."'><span>".$val->title."</span></a>";

                                      
        
                                        }
                                    }
                                }
                            }
                            else {
                                         buildMenuClient2($menuu,$id);
                                        }
                            function buildMenuClient2($data,$parent_id){
                                
                                foreach ($data as $val) {
                                 
                                    if($val->parent_id == $parent_id) {
                                        
                                        echo "<li>";
                                         
                                        //    if($val->type==2){
                                                    echo "<a  class='d-block' href='".route('home.list.category.post',['id'=>$val->id])."' id='view_category_post_".$val->id."'><span>".$val->name."</span></a></li>";
                                                // }  
                                        
                                            if(collect($data)->contains('parent_id', $val->id)){
                                            echo "<ul  class=\"ul-chid\" >";
                                            buildMenuClient2($data,$val->id);
                                            echo "</ul>";
                                            }
                                                // echo '</li>';
                                            echo "<span class=\"arrow-li\"></span>";
    
                                        echo "</li>";
                                    }
                                }
                            }
                                ?>     
                            </ul>
                            <script language="javascript">
 
                                // Lấy danh sách menu
                                var menu = document.querySelectorAll('#dropdown > li');
                            
                                // Lặp qua từng menu để gán sự kiện click
                                for (var i = 0; i < menu.length; i++)
                                {
                                    menu[i].addEventListener("mouseover", function()
                                    {
                                        // Ẩn hết menu con
                                        var menuList = document.querySelectorAll('#dropdown > li > ul');
                                        for (var j = 0; j < menuList.length; j++) {
                                            menuList[j].style.display = "none";
                                        }
                            
                                        // Hiển thị menu hiện tại
                                        // đối tượng this chính là thẻ li hiện tại
                                        // nên ta sử dụng mảng childrent để lấy danh sách thẻ con
                                        // mà thẻ ul nằm ở vị trí thứ 2 nên trong mảng con nó
                                        // sẽ có vị trí là 1 (mảng bắt đầu từ 0)
                                        this.children[1].style.display = "block";
                                    });
                                }
                            </script>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
                        </div>
                    </div>
                </div>
        
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content-page">
                    <div class="title_product">
                        <p>{{ $post == null ? ' ' : $post->title}}</p>
                    </div>
                   
                    <div class="noi_dung">
                          {!! $post == null ? ' ' : $post->content!!}
                      
                    </div>





                </div>
            </div>
            
            </div>
        </div>
    
    



















    <!-- End Sidebar Container -->
@endsection
@section('script-client')

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
                     saveCommentPost();
                        
                    } 
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        })();
    //Comment post
   function saveCommentPost(){
        var email = $('#email').val();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var message = $('#message').val();
        var link_id = $('#link_id').val();
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
         $.ajax({
                type: "POST",
                url: "{{ route('post.add.comment') }}",
                data: {
                    email: email,
                    firstname: firstname,
                    lastname: lastname,
                    link_id :link_id,
                    message: message
                },
                success:function(data) {
                    showMessage('Bình luận đã được ghi lại',1);                   
                },
                error: function(response) {
                    $('#lastnameErr').text(response.responseJSON.errors.lastname);
                    $('#firstnameErr').text(response.responseJSON.errors.firstname);
                    $('#emailErr').text(response.responseJSON.errors.email);
                    $('#messageErr').text(response.responseJSON.errors.message);
               }
            })

    };

    function showMessage(message,type) {

    if (type == 1) {
        notify("<div style='font-size:15px'><i class='fa fa-check'></i>" + message + " </div>",'success');
    } else {
        notify("<div style='font-size:15px'><i class='fa fa-check'></i> " + message + " </div>",'error');
    };
  
}  
    
</script>

@endsection
@section('script-client')
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
     <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

@endsection