@section('link-css')
    <style>
        .radio-template+label::before {
            border: 2px solid #3494E6 !important;
        }
        select.form-control:not([size]):not([multiple]) {
            height: inherit;
        }
    </style>
@endsection
@extends('master.user')
@section('content')
    <section class="checkout" style="padding-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tab-content">
                        <div id="address" class="active tab-block"> 
                            <form action="{{ route('user.checkout.address') }}" method="POST">
                                @csrf
                                <!-- Shippping Address-->
                                <div id="shippingAddress" aria-expanded="false">
                                    <div class="block-header mb-5 mt-3">
                                        <h6>Shipping address</h6>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="shipping_name" class="form-label">Name</label>
                                            <input id="shipping_name" type="text" name="shipping_name" value="{{ Auth::user()->name }}" placeholder="Enter you first name" class="form-control">
                                            @if ($errors->has('shipping_name'))
                                                <div class="text-danger pl-3">
                                                    <small><strong>{{ $errors->first('shipping_name') }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="shipping_email" class="form-label">Email Address</label>
                                            <input id="shipping_email" type="email" value="{{ Auth::user()->email }}"  name="shipping_email" placeholder="enter your email address" class="form-control">
                                            @if ($errors->has('shipping_email'))
                                                <div class="text-danger pl-3">
                                                    <small><strong>{{ $errors->first('shipping_email') }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="shipping_street" class="form-label">Street</label>
                                            <input id="shipping_address" type="text" class="form-control" name="shipping_address" value="{{ Auth::user()->street ? Auth::user()->street : old('shipping_address') }}">
                                            @if ($errors->has('shipping_address'))
                                                <div class="text-danger pl-3">
                                                    <small><strong>{{ $errors->first('shipping_address') }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="shipping_city" class="form-label">City</label>
                                            <input id="shipping_city" type="text" name="shipping_city" placeholder="Your city" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="shipping_state" class="form-label">State</label>
                                            <select id="shipping_state" class="form-control" name="shipping_state">
                                                    <option value="Lagos">Lagos</option>
                                            </select>
                                            @if ($errors->has('shipping_state'))
                                                <div class="text-danger pl-3">
                                                    <small><strong>{{ $errors->first('shipping_state') }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="shipping_phone-number" class="form-label">Phone Number</label>
                                            <input id="shipping_phone-number" type="tel" name="shipping_phone_number" value="{{ Auth::user()->tel ? Auth::user()->tel : old('shipping_phone_number') }}"  placeholder="Your phone number" class="form-control">
                                            @if ($errors->has('shipping_phone_number'))
                                                <div class="text-danger pl-3">
                                                    <small><strong>{{ $errors->first('shipping_phone_number') }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- /Shipping Address-->
                                        <div class="card-body">
                                            <input type="checkbox" value="1" name="shipping" id="paymentmethod2">
                                            <label for="payment-method-2"><strong>Pay on Delivery</strong><br><span class="label-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="CTAs d-flex justify-content-between flex-column flex-lg-row"><a href="{{ route('view.cart') }}" class="btn btn-template-outlined wide prev"> <i class="fa fa-angle-left"></i>Back to basket</a><button type="submit" class="btn btn-template wide next">Payment Method<i class="fa fa-angle-right"></i></button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block-body order-summary">
                        <h6 class="text-uppercase">Order Summary</h6>
                        <p>Shipping and additional costs are calculated based on values you have entered</p>
                        <ul class="order-menu list-unstyled">
                            <li class="d-flex justify-content-between"><span>Order Subtotal </span><strong>&#8358;{{ number_format($total, 2, '.', ',') }}</strong></li>
                            <li class="d-flex justify-content-between"><span>Shipping and handling</span><strong>0.00</strong></li>
                            <li class="d-flex justify-content-between"><span>Tax</span><strong>0.00</strong></li>
                            <li class="d-flex justify-content-between"><span>Total</span><strong class="text-primary price-total">&#8358;{{ number_format($total, 2, '.', ',') }}</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </section>
@endsection
@section('link-js')
@endsection