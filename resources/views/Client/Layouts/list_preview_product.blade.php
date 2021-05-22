<div id="new-product" class="py-5">
    <div class="row">
        <div class="col d-flex title" style="justify-content: space-between">

            @if ($type == 0)
                <a href="{{ route('get.list.product', $data[0]->id) }}">
                    <p class="title-cat text-center p-2">{{ $data[0]->name }}</p>
                </a>
            @else
                <a href="">
                    <p class="title-cat text-center p-2">PRODUCTS ARE INTERESTED</p>
                </a>
            @endif


            <a class="more text-dark text-right" href="{{ route('get.list.product', $data[0]->id) }}">
                More... <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
    <div class="gallery js-flickity" data-flickity='{ "autoPlay": true , "wrapAround": true,  "imagesLoaded": true}' style="padding-top: 20px">

        @foreach ($data[1] as $item)
            @if ($loop->iteration % 10 == 1)
                <div class="col-12">
                    <div class="gallery-cell">
                        <div class="row">
            @endif
            <div class="col-md-2dot4">
                <div id="wp-product" class="bg-white mb-4">
                    <div id="thumb">
                        <a href="{{ route('home.list.product', $item->id) }}">
                            @if (isset( $item->Media->url))
                            <img src="{{asset('Media/'.$item->Media->url)}}" class="img-fluid" alt="" />
                            @endif
                        </a>
                    </div>
                    <div id="info" class="text-center text-decoration-none">
                        <a href="{{ route('home.list.product', $item->id) }}"
                            class="d-block text-dark">{{ $item->title }}</a>
                    </div>
                    <div id="price" class="text-center pt-2 pb-3">
                        <span
                            class="text-danger">{{ $item->price == null ? '' : number_format($item->price) . '₫' }}</span>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 5 == 0 && $loop->iteration % 10 != 0 && $loop->iteration > 1 && $loop->iteration < 30)
    </div>
    <div class="row">
        @endif
        @if ($loop->iteration % 10 == 0)
    </div>
</div>
</div>
@elseif ($loop->last)
</div>
</div>
</div>
@break
@endif




@if ($loop->iteration == 30)
    {{-- </div> --}}
    @break
@endif

{{-- <div class="col-md-3">
                        <div id="wp-product" class="bg-white mb-4">
                            <div id="thumb">
                                <a href="{{route('home.list.product',$item2->id)}}">
                                    <img src="{{asset('Media/'.$item2->Media->url)}} class="img-fluid" alt=""/>
                                </a>
                            </div>
                            <div id="info" class="text-center text-decoration-none">
                                <a href="{{route('home.list.product',$item2->id)}}" class="d-block text-dark">
                                    {{$item2->title}}
                                </a>
                            </div>
                            <div id="price" class="text-center pt-2 pb-3">
                                <span class="text-danger">  {{number_format($item2->price)}} Đ</span>
                            </div>
                        </div>
                    </div> --}}
@endforeach

</div>
{{-- </div> --}}
{{-- </div> --}}

<!-- -----------hướng dẫn sử dụng --------------  -->

</div>
