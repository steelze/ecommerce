@section('link-css')
@endsection
@extends('master.user')
@section('content')
    <!-- Hero Section-->
    @include('layouts.user.cart.hero')
    <!-- Shopping Cart Section-->
    @if(session()->has('cart') && session('cart')->totalQty > 0)
        @include('layouts.user.cart.cart')
        <!-- Order Details Section-->
        @include('layouts.user.cart.detail')
    @endif  
@endsection
@section('link-js')
@endsection