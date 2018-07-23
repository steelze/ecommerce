@extends('master.admin')
@section('link-css')
    {{-- <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}"> --}}
    <style>
        /* .selection{
            width: 100%;
        } */
    </style>
@endsection
@section('content')
  <section>
        <div class="container-fluid">
            <div class="row">
                <!-- Horizontal Form-->
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Add SubCategory</h3>
                        </div>
                        <div class="card-body">
                            @if(session('msg'))
                                <p class="text-success text-center">{{ session('msg') }}</p> 
                            @endif
                            <form class="form-horizontal" method="POST" action="{{ route('subcategory.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Subcategory Name" name="name" value="{{ old('name') }}" class="form-control form-control-success">
                                        @if ($errors->has('name'))
                                            <div class="text-danger">
                                                <small><strong>{{ $errors->first('name') }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Category:</label>
                                    <div class="col-sm-9">
                                        <select name="category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    @if(old('category') == $category->id )
                                                        selected 
                                                    @endif
                                                >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category'))
                                            <div class="text-danger">
                                                <small><strong>{{ $errors->first('category') }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">       
                                    <div class="col-sm-9 offset-sm-3">
                                        <input type="submit" value="submit" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>
@endsection
@section('link-js')
    {{-- <script src="{{ asset('admin/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.category-select').select2();
        });
    </script> --}}
@endsection