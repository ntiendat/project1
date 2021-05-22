<div class="row cate-desktop">
    <div class="col-12">
        <div class="list_category row" style="margin-top:20px;">
            <div class="owl-carousel owl-theme" id="cate-list-desktop">
                @for ($i = 0; $i < 1; $i++)
                    <div class="item cate-item">
                        <div class="flex-container">
                            @foreach ($category as $key => $item)
                                @if ($key >= 0 && $key <= 7)
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">
                                        @if (isset($item->Media->url))
                                            <a href="{{ route('get.list.product', $item->id) }}"><img
                                                    class="d-block img-fluid"
                                                    src="{{ asset('Media/' . $item->Media->url) }}" alt="">
                                                {{ $item->name }}</a>
                                        @else
                                            <a href="{{ route('get.list.product', $item->id) }}"><img
                                                    class="d-block img-fluid" src="" alt="">
                                                {{ $item->name }}</a>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex-container">
                            @foreach ($category as $key => $item)
                                @if ($key > 7)
                                    @if (isset($item->Media->url))
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">
                                        <a href="{{ route('get.list.product', $item->id) }}"><img
                                                class="d-block img-fluid" src="{{ asset('Media/' . $item->Media->url) }}"
                                                alt="">
                                            {{ $item->name }}</a>
                                    </div>
                                    @else 
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">
                                        <a href="{{ route('get.list.product', $item->id) }}"><img
                                                class="d-block img-fluid" alt="">
                                            {{ $item->name }}</a>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>


<div class="row cate-mobile">
    <div class="col-12">
        <div class="list_category row" style="margin-top:20px;">
            <div class="owl-carousel owl-theme" id="cate-list-mobile">
                @for ($i = 0; $i < 1; $i++)
                    <div class="item cate-item">
                        <div class="flex-container">
                            @foreach ($category as $key => $item)
                                @if ($key >= 0 && $key <= 3)
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">
                                        @if (isset($item->Media->url))
                                            <a href="{{ route('get.list.product', $item->id) }}"><img class="img-fluid"
                                                    src="{{ asset('Media/' . $item->Media->url) }}" alt="">
                                                {{ $item->name }}</a>
                                        @else
                                                <a href="{{ route('get.list.product', $item->id) }}"><img
                                                        class="d-block img-fluid" src="" alt="">
                                                    {{ $item->name }}</a>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex-container">
                            @foreach ($category as $key => $item)
                                @if ($key > 3 && $key <= 7)
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">

                                        @if (isset($item->Media->url))
                                            <a href="{{ route('get.list.product', $item->id) }}"><img class="img-fluid"
                                                    src="{{ asset('Media/' . $item->Media->url) }}" alt="">
                                                {{ $item->name }}</a>
                                        @else
                                                <a href="{{ route('get.list.product', $item->id) }}"><img
                                                        class="d-block img-fluid" src="" alt="">
                                                    {{ $item->name }}</a>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="item cate-item">
                        <div class="flex-container">
                            @foreach ($category as $key => $item)
                                @if ($key > 7 && $key <= 11)
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">
                                        @if (isset($item->Media->url))
                                        <a href="{{ route('get.list.product', $item->id) }}"><img class="img-fluid"
                                                src="{{ asset('Media/' . $item->Media->url) }}" alt="">
                                            {{ $item->name }}</a>
                                    @else
                                            <a href="{{ route('get.list.product', $item->id) }}"><img
                                                    class="d-block img-fluid" src="" alt="">
                                                {{ $item->name }}</a>
                                    @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex-container">
                            @foreach ($category as $key => $item)
                                @if ($key > 11 && $key <= 15)
                                    <div class="detail_cate col-md-1dot5" style="height:250px;">
                                        @if (isset($item->Media->url))
                                        <a href="{{ route('get.list.product', $item->id) }}"><img class="img-fluid"
                                                src="{{ asset('Media/' . $item->Media->url) }}" alt="">
                                            {{ $item->name }}</a>
                                    @else
                                            <a href="{{ route('get.list.product', $item->id) }}"><img
                                                    class="d-block img-fluid" src="" alt="">
                                                {{ $item->name }}</a>
                                    @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<style>
    .cate-mobile {
        display: none;
    }

    @media (min-width: 1000px) {
        .col-md-1dot5 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 12.5%;
            flex: 0 0 12.5%;
            max-width: 12.5%;
        }
    }

    @media (max-width: 700px) {
        .cate-mobile {
            display: block;
        }

        .cate-desktop {
            display: none;
        }
    }

    .flex-container {
        display: flex;
        flex-wrap: nowrap;
    }

    .flex-container>div {
        background-color: white;
        text-align: center;
        line-height: 20px !important;
        font-size: 20px !important;
    }

</style>
<script>
    $("#cate-list-desktop").owlCarousel({
        // autoplay: true, //Set AutoPlay to 3 seconds
        // autoplayTimeout:5000,
        // autoplayHoverPause:true,
        items: 1,
        loop: true,
        dots: false,
    });
    $("#cate-list-mobile").owlCarousel({
        // autoplay: true, //Set AutoPlay to 3 seconds
        // autoplayTimeout:5000,
        // autoplayHoverPause:true,
        items: 1,
        loop: true,
        dots: false,
    });

</script>
