@extends('master.admin')
@section('link-css')
    <link rel="stylesheet" href="{{ asset('/admin/vendor/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
  <section>
        <div class="container-fluid">
            <div class="row">
                <!-- Horizontal Form-->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Edit Product</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label class="form-control-label">Name:</label>
                                        <input type="text" placeholder="Product Name" name="name" value="{{ $product->name }}" class="form-control form-control-success">
                                        <input type="text" hidden name="id" value="{{ $product->id }}">
                                        @if ($errors->has('name'))
                                            <div class="text-danger">
                                                <small><strong>{{ $errors->first('name') }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-control-label">Category:</label>
                                        <select name="category_id" id="category_id" class="form-control" onchange="getSubctegories()">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    @if($product->category_id == $category->id )
                                                        selected 
                                                    @endif
                                                >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <div class="text-danger">
                                                <small><strong>{{ $errors->first('category_id') }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-control-label">SubCategory:</label>
                                        <div class="sk-three-bounce" style="display: none;" id="loading">
                                            <div class="sk-child sk-bounce1"></div>
                                            <div class="sk-child sk-bounce2"></div>
                                            <div class="sk-child sk-bounce3"></div>
                                        </div>
                                        <select name="sub_category_id" class="form-control" id="sub_category_id">
                                            @if($product->sub_category_id)
                                                <option value="{{ $product->subCategory->id }}">{{ $product->subCategory->name }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-control-label">Brand:</label>
                                        <select name="brand_id" id="brand" class="form-control">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" 
                                                    @if($product->brand_id == $brand->id )
                                                        selected 
                                                    @endif
                                                >{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="form-control-label">Price:</label>
                                                <input type="number" placeholder="Price" name="price" min="0" value="{{ $product->price }}" class="form-control form-control-success">
                                                @if ($errors->has('price'))
                                                    <div class="text-danger">
                                                        <small><strong>{{ $errors->first('price') }}</strong></small>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-control-label">R. Price <small><i>(If applicable)</i></small></label>
                                                <input type="number" placeholder="R. Price" name="last_price" min="0" value="{{ old('last_price') }}" class="form-control form-control-success">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Form-->
                                    <div class="col-lg-2">
                                        <label class="form-control-label">Quantity:</label>
                                        <input type="number" id="qty" name="qty" min="0" class="form-control" value="{{ $product->qty }}">
                                    </div>
                                    <!-- Rounded switch -->
                                    <div class="col-lg-2" style="margin-top: 4%;">
                                        <div class="i-checks">
                                            <input type="checkbox" class="checkbox-template" value="1" name="featured" @if($product->featured) checked @endif>
                                            <label for="">Featured</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="form-control-label">Description:</label>
                                        <textarea class="summernote" name="description">{{ $product->description }}</textarea>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <label class="form-control-label">Images:</label>
                                        <input type="file" name="image[]" id="image" multiple>
                                        @if ($errors->has('image.*'))
                                            <div class="text-danger">
                                                <small><strong>{{ $errors->first('image.*') }}</strong></small>
                                            </div>
                                        @endif
                                    </div> --}}
                                    <div class="col-lg-4 mt-4">       
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
<!-- Summernote-->
    <script src="{{ asset('/admin/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            height:300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        function getSubctegories() {
            removeOptions(document.getElementById('sub_category_id'));
            let value = document.getElementById('category_id').value;
            if(value === "") return false;
            document.getElementById('loading').style.display = 'block';
            let url = "{{ url('admin/subcategory/list') }}";
            url = `${url}/${value}`
            fetch(url).then( (response) => {
                return response.json();
            }).then((data) => {
                data.map(function(s) {
                    let countryElement = createElement('option', s.name, s.id);
                    appendToTag('sub_category_id', countryElement);
                    document.getElementById('loading').style.display = 'none';
                });
            }).catch( (e) => {
                console.log(e);
            })
        }
        function createElement(el, text, value) {
            let option = document.createElement(el);
            option.text = text;
            option.value = value;
            return option;
        }
        function appendToTag(tag, ele) {
            let select = document.getElementById(tag);
            select.appendChild(ele);
        }

        function removeOptions(selectbox)
        {
            for(let index = selectbox.options.length - 1 ; index >= 0 ; index--)
            {
                selectbox.remove(index);
            }
        }
    </script>
    </script>
@endsection