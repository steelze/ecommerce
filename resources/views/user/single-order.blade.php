@extends('master.user')
@section('link-css')
    <style>
        select.form-control:not([size]):not([multiple]) {
            height: inherit;
        }
    </style>
@endsection
@section('content')
    <section class="hero hero-page gray-bg padding-small">
        <div class="container">
        <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1">
                <h1>Order #{{ $order->order_id }}</h1><p class="lead">Order #{{ $order->order_id }} was placed on <strong>{{ $order->created_at->format('d M Y h:i:s A') }}</strong> and is currently <strong>Being prepared</strong>.</p><p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
            <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('view.order', ['email' => Auth::user()->email, 'logged_in' => 'true']) }}">Orders</a></li>
                <li class="breadcrumb-item active">Order #{{ $order->order_id }}</li>   
            </ul>
            </div>
        </div>
        </div>
    </section>
    <section class="padding-small">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xl-9 pl-lg-3 offset-lg-2">
                <div class="basket basket-customer-order">
                  <div class="basket-holder">
                    <div class="basket-header">
                      <div class="row">
                        <div class="col-6">Product</div>
                        <div class="col-2">Price</div>
                        <div class="col-2">Quantity</div>
                        <div class="col-2 text-right">Total</div>
                      </div>
                    </div>
                    <div class="basket-body">
                      <!-- Product-->
                      @foreach($order->cart['item'] as $item)
                      <div class="item">
                        <div class="row d-flex align-items-center">
                          <div class="col-6">
                            <div class="d-flex align-items-center"><img src="{{ asset("storage/product/".json_decode($item['item']['images'], true)[0]) }}" alt="..." class="img-fluid">
                              <div class="title"><a href="detail.html">
                                  <h6>{{ $item['item']['name'] }}</h6></a></div>
                                </div>
                            </div>
                            <div class="col-2"><span>
                                @if($item['item']['last_price'])
                                    &#8358;{{ $item['item']['last_price'] }}
                                @else
                                    &#8358;{{ $item['item']['price'] }}
                                @endif()
                            </span></div>
                            <div class="col-2">{{ $item['qty'] }}</div>
                            <div class="col-2 text-right"><span>&#8358;{{ number_format($item['price'], 2, '.', ',') }}</span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                    <div class="basket-footer">
                      <div class="item">
                        <div class="row">
                          <div class="offset-md-6 col-4"> <strong>Order subtotal</strong></div>
                          <div class="col-2 text-right"><strong>&#8358;{{ number_format($order->cart['totalPrice'], 2, '.', ',') }}</strong></div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="row">
                          <div class="offset-md-6 col-4"> <strong>Shipping and handling</strong></div>
                          <div class="col-2 text-right"><strong>0.00</strong></div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="row">
                          <div class="offset-md-6 col-4"> <strong>Tax</strong></div>
                          <div class="col-2 text-right"><strong>0.00</strong></div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="row">
                          <div class="offset-md-6 col-4"> <strong>Total</strong></div>
                          <div class="col-2 text-right"><strong>&#8358;{{ number_format($order->cart['totalPrice'], 2, '.', ',') }}</strong></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row addresses">
                  <div class="col-sm-6 offset-sm-3">
                    <div class="block-header">
                      <h6 class="text-uppercase">Shipping address</h6>
                    </div>
                    <div class="block-body">
                        <p>
                            {{ $order->shipping_details['shipping_name'] }}<br>
                            {{ $order->shipping_details['shipping_address'] }}<br>
                            @if($order->shipping_details['shipping_city'])
                            {{ $order->shipping_details['shipping_city'] }}<br>
                            @endif
                            {{ $order->shipping_details['shipping_state'] }}<br>
                            {{ $order->shipping_details['shipping_phone_number'] }}<br>
                        </p>
                    </div>
                  </div>
                </div>
                <!-- /.addresses  -->
              </div>
        </div>
        </div>
    </section>
@endsection