<section class="related-products">
    <div class="container">
        <header class="text-center">
            <h4>You may also like</h4>
        </header>
        <div class="row">
            <!-- item-->
            @foreach($featured as $featured_product)
                <div class="item col-lg-3">
                <div class="product is-gray">
                    <div class="image d-flex align-items-center justify-content-center"><img src="{{ asset("storage/product/".$featured_product->images[0]) }}" alt="..." class="img-fluid">
                    <div class="hover-overlay d-flex align-items-center justify-content-center">
                        <div class="CTA d-flex align-items-center justify-content-center"><a href="javascript:void(0)" class="add-to-cart" onclick="addSingleToCart({{$featured_product->id}})"><i class="fa fa-shopping-cart"></i></a><a href="{{ route('view.product', [$featured_product->category->slug, $featured_product->id, $featured_product->slug] )}}" class="visit-product active"><i class="icon-search"></i>View</a><a href="#" class="add-to-cart"><i class="fa fa-heart-o"></i></a></div>
                    </div>
                    </div>
                    <div class="title">
                        <a href="{{ route('view.product', [$featured_product->category->slug, $featured_product->id, $featured_product->slug] )}}">
                            <h3 class="h6 text-uppercase no-margin-bottom">{{ $featured_product->name }}</h3>
                        </a>
                        <span class="price">
                            @if($featured_product->last_price)
                                &#8358;{{ $featured_product->last_price }}
                            @else
                               &#8358;{{ $featured_product->price }}
                            @endif
                        </span>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
    </div>
</section>