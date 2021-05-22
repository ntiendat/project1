@extends('Client.Layouts.master')

@section('title-client')
    <title> Trang chủ</title>
@endsection

@section('content-client')
    <section>
        <div class="container">
            <div class="box-similar-product mt-4">

                <div class="box-bread">
                    <div class="row">
                      <div class="col-md-8">
                        <nav>
                          <ol class="breadcrumb" style="background-color: #f5f5f5">
                            <li class="breadcrumb-item">
                              <a href="">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                {{-- {{dd($tag)}} --}}
                              <a href="">{{$tag[0]->name}} </a>
                            </li>
                          
                          </ol>
                        </nav>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" id="filter">
                                <option value="1">Default order</option>
                                <option value="4">New</option>
                                <option value="5">Much interest</option>
                                <option value="2">Prices range from low to high</option>
                                <option value="3">Prices range from hight to low</option>
                            </select>
                          </div>
                      </div>
                    </div>
                </div>

                <div id="list">
                    @include('Client.Layouts.list_products' ,['data' => $data])
                </div>                      
            </div>
        </div>       
    </section>
 <script>

$(document).ready(
    function(){
        $("#filter").change(
            function(){
                var filter = $( "#filter" ).val();
                let url = '{{Request::root().'/client/product/filter/'}} '+filter;
                console.log(url);
                if(filter==2){
                $.ajax({
                    //gửi dữ liệu đi
                    url :url,
                    type:'GET',
                    //nhận dữ liệu về 
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==3 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==1 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==4 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
                else if(filter==5 ){
                    $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data){
                        $("#list").empty();
                        $('#list').html(data);
                    }
                });
                }
            }            
        );                              
    });
    </script>
@endsection
