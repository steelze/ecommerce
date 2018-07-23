<main>
    <div class="container">
        <div class="row">
            <!-- Grid -->
            <div class="products-grid col-12 sidebar-none">
                <div class="row">
                    @foreach($products as $product)
                    <!-- item-->
                    <div class="item col-xl-3 col-lg-4 col-md-6">
                        <div class="product is-gray">
                            <div class="image d-flex align-items-center justify-content-center">
                                @if($product->last_price)
                                    <div class="ribbon ribbon-primary text-uppercase">
                                        {{ $product->discount($product) }}%
                                    </div>
                                @endif
                                <img src="{{ asset("storage/product/".$product->images[0]) }}" alt="product" class="img-fluid">
                                <div class="hover-overlay d-flex align-items-center justify-content-center">
                                <div class="CTA d-flex align-items-center justify-content-center"><a href="javascript:void(0)" class="add-to-cart" onclick="addSingleToCart({{$product->id}})"><i class="fa fa-shopping-cart"></i></a><a href="{{ route('view.product', [$product->category->slug, $product->id, $product->slug]) }}" class="visit-product active"><i class="icon-search"></i>View</a><a href="javascript:void(0)"><i class="fa fa-heart-o"></i></a></div>
                                </div>
                            </div>
                            <div class="title">
                                <small class="text-muted">{{ $product->category->name }}</small><a href="{{ route('view.product', [$product->category->slug, $product->id, $product->slug] )}}">
                                        <h3 class="h6 text-uppercase no-margin-bottom">{{ $product->name }}</h3></a>
                                @if($product->last_price)
                                    <span class="price text-muted" style="text-decoration: line-through;">
                                        &#8358;{{ $product->price }}
                                    </span>
                                    <span class="price text-muted" style="padding-left: 20%;">
                                        &#8358;{{ $product->last_price }}
                                    </span>
                                @else
                                    <span class="price text-muted">&#8358;{{ $product->price }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="CTA d-flex pull-right">
                    <a href="{{ route('all.product') }}" class="btn btn-template wide">See All</a>
                </div>
            </div>
            <!-- / Grid End-->
        </div>
    </div>
</main>