    <div class="row">

        <div class="slider-main-area col-md-9 sm-12 md 9" style="margin-top:30px !important;">
            <div class="slider-active owl-carousel">
                @foreach ($data as $item)
                    <!-- slider-wrapper start -->
                <div class="slider-wrapper">
                    @if ($item->Media != null) 
                        <img src="{{asset('/Media/'.$item->Media->url)}}" alt="anh" class="anh" width="1120px" style="height: 346px;">
                    @else 
                        <img src="" alt="anh" class="anh" width="1120px" style="height: 346px;">
                    @endif
                </div>
                  
                @endforeach
            </div>
                    <!-- slider-wrapper end -->
        </div>
        <div class="col-md-3 sm-12 lg-3">
            <div class="inner">
                <div class="x md-x lg-x y md-y lg-y">
                    <div style="padding-top:30px;">
                    <img src="{{ asset('Media/0d36abe84bf1f039c4824e47f1bee03f.png') }}" alt="anh" style="width:100% !important; height:170px !important;">
                    </div>
                </div>
                <div class="x md-x lg-x y md-y lg-y">
                    <div style="padding-top:10px;">
                    <img src="{{ asset('Media/7ebc6293a43ccc9e2d171ec005d2db40.jpg') }}" alt="anh" style="width:100% !important; height:170px !important;">
                    </div>
                </div>
            </div>
        </div>
    </div>
            <script src="{{asset('slide/js/vendor/jquery-1.12.4.min.js')}}"></script>
		<!-- all plugins JS hear -->		
        <script src="{{asset('slide/js/popper.min.js')}}"></script>	
        <script src="{{asset('slide/js/bootstrap.min.js')}}"></script>	
        <script src="{{asset('slide/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('slide/js/jquery.mainmenu.js')}}"></script>	
        <script src="{{asset('slide/js/ajax-email.js')}}"></script>
        <script src="{{asset('slide/js/plugins.js')}}"></script>
		<!-- main JS -->		
        <script src="{{asset('slide/js/main.js')}}"></script>
        
