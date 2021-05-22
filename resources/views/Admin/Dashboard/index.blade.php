@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        </ol>
      </nav>

    

      <style>
         /*css thống kê dashboard*/
            .panel-primary {
                border-color: #337ab7 !important;

            }
            .panel-primary .panel-heading {
                border-color: #337ab7;
                color: #fff;
                background-color: #337ab7;
            }
            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
          
            .panel-heading {
                padding: 10px 15px;
                border-bottom: 1px solid transparent;
                border-top-left-radius: 3px;
                border-top-right-radius: 3px;
            }
            .panel-footer {
                padding: 10px 15px;
                background-color: #f5f5f5;
                border-top: 1px solid #ddd;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
            }
            .panel-green {
                border-color: #5cb85c;
            }
            .panel-green .panel-heading {
                border-color: #5cb85c;
                color: #fff;
                background-color: #5cb85c;
            }
            .panel-yellow {
                border-color: #f0ad4e;
            }
            .panel-yellow .panel-heading {
                border-color: #f0ad4e;
                color: #fff;
                background-color: #f0ad4e;
            }
            .panel-red {
                border-color: #d9534f;
            }
            .panel-red .panel-heading {
                border-color: #d9534f;
                color: #fff;
                background-color: #d9534f;
            }
            .huge {
                font-size: 40px;
            }
               /*---------------------*/
           

      </style> 
      <div id="page-wrapper">
     <div class="row">
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                             <i class="fa fa-shopping-cart fa-5x"></i>
                          </div>
                         
                          <div class="col-xs-9 text-right">
                              <div class="huge">{{ $product }}</div>
                              <div>Tổng số sản phẩm</div>
                          </div>
                       
                      </div>
                  </div>
                  <a href=" {{route('index.product')}} ">
                      <div class="panel-footer">
                          <span class="pull-left">Xem chi tiết</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-green">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-images fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">{{ $media }}</div>
                              <div>Tổng số ảnh</div>
                          </div>
                      </div>
                  </div>
                  <a href=" {{route('index.image.media')}} ">
                      <div class="panel-footer">
                          <span class="pull-left">Xem chi tiết</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-yellow">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-newspaper fa-5x"></i>
                             
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge"> {{ $post }} </div>
                              <div>Tổng bài viết</div>
                          </div>
                      </div>
                  </div>
                  <a href=" {{route('index.post')}} ">
                      <div class="panel-footer">
                          <span class="pull-left">Xem chi tiết</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="panel panel-red">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-users fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">{{ $users1 }}</div>
                              <div>Số khách hàng </div>
                          </div>
                      </div>
                  </div>
                 <a href=" {{route('index.user')}}">
                      <div class="panel-footer">
                          <span class="pull-left">Xem chi tiết</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
  <h3 style="text-align: center;"> Biểu đồ thống kê người dùng</h3>
  <div class="row">
      <div class="col-md-12 col-sm-6">
        {!! $chart_sub->container() !!}
        {!! $chart_sub->script() !!}
      </div>
  </div><br>
  <h3 style="text-align: center;"> Bảng thống kê người dùng click vào bài viết</h3><br>
  <div id="tag_container">
    @include('Admin.Dashboard.presult')
  </div>
  <br>
  <h3 style="text-align: center;"> Bảng thống kê người dùng click vào sản phẩm</h3><br>
  <div id="tag_product_container">
    @include('Admin.Dashboard.presult_product')
  </div>
</div>
  
@endsection


@section('script')
  <script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script>
{{-- <script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var pages = window.location.hash.replace('#', '');
            if (pages == Number.NaN || pages <= 0) {
                return false;
            }else{
                getDatas(pages);
            }
        }
    });
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var pages= $(this).attr('href').split('page=')[1];
            getDatas(pages);
        });
  
    });
  
    function getDatas(pages){
        $.ajax(
        {
            url: '?page=' + pages,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_product_container").empty().html(data);
            location.hash = pages;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script> --}}

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
 {{--  <!-- plugin js -->
  <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
  
  <!-- jquery.vectormap map -->
  <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
  
  <!-- Calendar init -->
  <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script> --}}
        
@endsection