<section class="shopping-cart">
    <div class="container">
        <div class="basket">
            <div class="basket-holder">
                <div class="basket-header">
                    <div class="row">
                        <div class="col-5">Product</div>
                        <div class="col-2">Price</div>
                        <div class="col-2">Quantity</div>
                        <div class="col-2">Total</div>
                        <div class="col-1 text-center">Remove</div>
                    </div>
                </div>
                <div class="basket-body">
                    <!-- Product-->
                    <form action="{{ route('update.cart') }}" method="POST" id="update-cart">
                        @foreach(session('cart')->items as $item)
                            @csrf
                            <div class="item">
                                <div class="row d-flex align-items-center">
                                <div class="col-5">
                                    <div class="d-flex align-items-center"><img src="{{ asset('storage/product/'.json_decode($item['item']['images'], true)[0]) }}" alt="..." class="img-fluid">
                                    <div class="title"><a href="javascript:void(0)">
                                        <h5>{{ $item['item']['name'] }}</h5></a></div>
                                    </div>
                                </div>
                                <div class="col-2"><span>{{ ($item['item']['last_price']) ? $item['item']['last_price'] : $item['item']['price'] }}</span></div>
                                <div class="col-2">
                                    <div class="d-flex align-items-center">
                                    <div class="quantity d-flex align-items-center">
                                        <div class="dec-btn">-</div>
                                        <input type="number" value="{{ $item['qty'] }}" name="quantity-{{$item['item']['id']}}" id="quantity-no" class="quantity-no" max="{{ $item['item']['qty'] }}">
                                        <div class="inc-btn">+</div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-2"><span>&#8358;{{ number_format($item['price'], 2, '.', ',') }}</span></div>
                                <div class="col-1 text-center"><i class="delete fa fa-trash"></i></div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="CTAs d-flex align-items-center justify-content-center justify-content-md-end flex-column flex-md-row"><a href="shop.html" class="btn btn-template-outlined wide">Continue Shopping</a>
        <a href="javascript:void(0)" class="btn btn-template wide" onclick="document.getElementById('update-cart').submit()">Update Cart</a>
    </div>
    </div>
</section>