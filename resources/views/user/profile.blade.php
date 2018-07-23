@extends('master.user')
@section('link-css')
    <style>
        select.form-control:not([size]):not([multiple]) {
            height: inherit;
        }
    </style>
@endsection
@section('content')
    <!-- Hero Section-->
    <section class="padding-small">
        <div class="container">
            <div class="row">
            <!-- Customer Sidebar-->
            @include('layouts.user.profile.sidebar')
            @include('layouts.user.profile.main')
            </div>
        </div>
        </section>
@endsection