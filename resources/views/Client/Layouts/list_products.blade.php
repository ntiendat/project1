<div class="row">
    @foreach ($data as $product)

    
        <div class="col-md-3">
            <div class="cell-pro-list">
                <div class="img-pro-list">
                    <a href="{{ route('home.list.product', $product->id) }}">
                        @if ($product->product_media_id != null)
                        <img src="{{ asset('Media/' . $product->Media->url) }}" class="img-fluid" alt="">
                    @else
                        <img src="" class="img-fluid" alt="">
                    @endif
                    </a>
                </div>
                <p class="title-pro-list">
                    <a href="{{ route('home.list.product', $product->id) }}">
                        {{ $product->title }} </a>
                </p>
            </div>
        </div>
 













        {{-- <div class="col-md-3 col-sm-4 col-5 mb-3">
            <div id="wp-product" class="bg-white">
                <div id="thumb">
                    <a href="{{ route('home.list.product', $product->id) }}">
                        @if ($product->product_media_id != null)
                            <img src="{{ asset('Media/' . $product->Media->url) }}" class="img-fluid" alt="">
                        @else
                            <img src="Media/image_product.jpg" class="img-fluid" alt="">
                        @endif
                    </a>
                </div>

                <div id="info" class="text-center text-decoration-none">
                    <a href="{{ route('home.list.product', $product->id) }}"
                        class="d-block text-dark">{{ $product->title }}</a>
                </div>

                <div id="price" class="text-center pt-2 pb-3">
                    <p class="text-danger"> {{ $product->price == null ? '' : number_format($product->price) }} </p>
                </div>

            </div>
        </div> --}}
    @endforeach
</div>
<style>
    @media only screen and (max-width: 900px) {
        .col-md-2 {
            width: 25%;
            font-size: 50%;
        }
    }

</style>
