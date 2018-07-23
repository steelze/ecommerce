<section class="order-details no-padding-top"> 
    <div class="container">
        <div class="row">                         
        <div class="col-lg-6">
            <div class="block">
            <div class="block-header">
                <h6 class="text-uppercase">Coupon Code</h6>
            </div>
            <div class="block-body">
                <p>If you have a coupon code, please enter it in the box below</p>
                <form action="#">
                <div class="form-group d-flex">
                    <input type="text" name="coupon">
                    <button type="submit" class="cart-black-button">Apply coupon</button>
                </div>
                </form>
            </div>
            </div>
            <div class="block">
            <div class="block-header">
                <h6 class="text-uppercase">Instructions for seller</h6>
            </div>
            <div class="block-body">
                <p>If you have some information for the seller you can leave them in the box below</p>
                <form action="#">
                <textarea name="instructions"></textarea>
                </form>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="block">
            <div class="block-header">
                <h6 class="text-uppercase">Order Summary</h6>
            </div>
            <div class="block-body">
                <p>Shipping and additional costs are calculated based on values you have entered.</p>
                <ul class="order-menu list-unstyled">
                <li class="d-flex justify-content-between"><span>Order Subtotal </span><strong>&#8358;{{ number_format(session('cart')->totalPrice, 2, '.', ',') }}</strong></li>
                <li class="d-flex justify-content-between"><span>Shipping and handling</span><strong>0.00</strong></li>
                <li class="d-flex justify-content-between"><span>Tax</span><strong>0.00</strong></li>
                <li class="d-flex justify-content-between"><span>Total</span><strong class="text-primary price-total">&#8358;{{ number_format(session('cart')->totalPrice, 2, '.', ',') }}</strong></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-lg-12 text-center CTAs"><a href="{{ route('user.checkout') }}" class="btn btn-template btn-lg wide">Proceed to checkout<i class="fa fa-long-arrow-right"></i></a></div>
        </div>
    </div>
</section>