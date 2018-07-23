<section class="product-details">
    <div class="container">
        <div class="row">
            <div class="product-images col-lg-6">
                @if($product->qty <= 0)
                    <div class="ribbon-warning text-uppercase">
                    Out of Stock
                    </div>
                @endif
                @if($product->last_price)
                    <div class="ribbon-primary text-uppercase">
                        {{ $product->discount($product) }}%
                    </div>
                @endif
                <div data-slider-id="1" class="owl-carousel items-slider owl-drag">
                    @foreach($product->images as $image)
                        <div class="item"><img src="{{ asset("storage/product/$image") }}" alt="{{ $product->image }}"></div>
                    @endforeach
                </div>
                <div data-slider-id="1" class="owl-thumbs d-flex align-items-center justify-content-center">
                    @foreach($product->images as $image)
                        <button class="owl-thumb-item"><img src="{{ asset("storage/product/$image") }}" alt="{{ $product->image }}"></button>
                    @endforeach
                </div>
                </div>
                <div class="details col-lg-6">
                <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row">
                    <ul class="price list-inline no-margin">
                        @if($product->last_price)
                            <li class="list-inline-item original">&#8358;{{ $product->price }}</li>
                            <li class="list-inline-item current">&#8358;{{ $product->last_price }}</li>
                        </span>
                        @else
                            <li class="list-inline-item current">&#8358;{{ $product->price }}</li>
                        @endif
                    </ul>
                    <div class="review d-flex align-items-center">
                    <ul class="rate list-inline">
                        <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                    </ul><span class="text-muted">5 reviews</span>
                    </div>
                </div>
                @if($product->description)
                    {!! substr($product->description, 0, 148) !!}...
                @else
                    <p class="text-center">No description Available</p>
                @endif
                <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                    <div class="quantity d-flex align-items-center">
                    <div class="dec-btn">-</div>
                    <input type="number" value="1" id="quantity-no" class="quantity-no" max="{{ $product->qty }}">
                    <div class="inc-btn">+</div>
                    </div>
                </div>
                <ul class="CTAs list-inline">
                    @if($product->qty > 0)
                        <li class="list-inline-item"><a href="javascript:void(0)" onclick="addMultipleToCart({{ $product->id }})" class="btn btn-template wide"> <i class="icon-cart"></i>Add to Cart</a></li>
                    @endif
                    <li class="list-inline-item"><a href="#" class="btn btn-template-outlined wide"> <i class="fa fa-heart-o"></i>Add to wishlist</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>