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
            <h1>Your orders</h1><p class="lead">Your orders in one place.</p>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
            <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ul>
            </div>
        </div>
        </div>
    </section>
    <section class="padding-small">
        <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9 pl-lg-3 offset-lg-2">
            <table class="table table-hover table-responsive-md">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th>#{{ $order->order_id }}</th>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ number_format($order->cart['totalPrice'], 2, '.', ',') }}</td>
                            <td><span class="badge badge-info">Being prepared</span></td>
                            {{-- <td><a href="{{}}" class="btn btn-primary btn-sm">View</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </section>
@endsection