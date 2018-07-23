@extends('master.admin')
@section('link-css')
@endsection
@section('content')
  <section>
        <div class="container-fluid">
            <div class="row">
                <!-- Horizontal Form-->
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Edit Category</h3>
                        </div>
                        <div class="card-body">
                            @if(session('msg'))
                                <p class="text-success text-center">{{ session('msg') }}</p> 
                            @endif
                            <form class="form-horizontal" method="POST" action="{{ route('category.update', $category->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" placeholder="Category Name" name="name" value="{{ $category->name }}" class="form-control form-control-success" required>
                                        @if ($errors->has('name'))
                                            <div class="text-danger">
                                                <small><strong>{{ $errors->first('name') }}</strong></small>
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
@endsection