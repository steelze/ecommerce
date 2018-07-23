@section('link-css')
@endsection
@extends('master.user')
@section('content')
    @if($product)
    <!-- Hero Section-->
    @include('layouts.user.product.map')
    <!-- Product Detail -->
    @include('layouts.user.product.detail')
    <!-- Product Description -->
    @include('layouts.user.product.description')
    <!-- Product Related -->
    @else
    @include('layouts.error.notfound')
    @endif
    @include('layouts.user.product.related')
    <!-- Footer-->
@endsection
@section('link-js')
@endsection