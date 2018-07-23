@extends('master.user')
@section('content')
<div class="col-lg-4 offset-lg-4">
    <div class="block-body order-summary">
        <h6 class="text-uppercase">Order Summary</h6>
        <p>Shipping and additional costs are calculated based on values you have entered</p>
        <ul class="order-menu list-unstyled">
            <li class="d-flex justify-content-between"><span>Order Subtotal </span><strong>&#8358;{{ number_format(session('cart')->totalPrice, 2, '.', ',') }}</strong></li>
            <li class="d-flex justify-content-between"><span>Shipping and handling</span><strong>0.00</strong></li>
            <li class="d-flex justify-content-between"><span>Tax</span><strong>0.00</strong></li>
            <li class="d-flex justify-content-between"><span>Total</span><strong class="text-primary price-total">&#8358;{{ number_format(session('cart')->totalPrice, 2, '.', ',') }}</strong></li>
        </ul>
        <form method="POST" action="{{ route('checkout.pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            <div class="row" style="margin-bottom:40px;">
              <div class="col-md-8 col-md-offset-2">
                <input type="hidden" name="email" value="{{  Auth::user()->email }}"> {{-- required --}}
                <input type="hidden" name="first_name" value="{{  Auth::user()->name }}"> {{-- required --}}
                <input type="hidden" name="orderID" value="123">
                <input type="hidden" name="amount" value="{{ session('cart')->totalPrice * 100 }}"> {{-- required in kobo --}}
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="metadata" value="{{ json_encode($array = ['user_id' => Auth::user()->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}
                <p>
                  <button class="btn btn-template wide" type="submit" value="Pay Now!">
                  <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                  </button>
                </p>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection