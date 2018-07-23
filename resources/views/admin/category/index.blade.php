@extends('master.admin')
@section('link-css')
  <link rel="stylesheet" href="{{ asset('admin/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
   <link rel="stylesheet" href="{{ asset('admin/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
   <link rel="stylesheet" href="{{ asset('admin/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
  <section>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-right">Add New</a>
          <h4>Categories</h4>
        </div>
        <div class="card-body">
          @if(session('msg'))
            <p class="text-success text-center">{{ session('msg') }}</p> 
          @endif
          <div class="table-responsive">
            <table id="datatable1" style="width: 100%;" class="table">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Name</th>
                  <th>Products</th>
                  <th>SubCategories</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>{{ $loop->index + 1}}</td>
                  <td><a href="javascript:void(0)" class="text-muted">{{ $category->name }}</a></td>
                  <td><a href="javascript:void(0)" class="text-muted">{{ $category->product->count() }}</a></td>
                  <td><a href="javascript:void(0)" class="text-muted">{{ $category->subcategory->count() }}</a></td>
                  <td><a href="{{ route('category.edit', $category->id) }}"><i class="fa fa-pencil"></i></a></td>
                  <form id="del-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                  </form>
                  <td>
                    <a href="#"
                      onclick="
                        event.preventDefault(); 
                        if(confirm('Are You Sure You want to delete this')) document.getElementById(`del-${ {{ $category->id }} }`).submit();
                      ">
                      <i class="fa fa-trash"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('link-js')
    <!-- Data Tables-->
    <script src="{{ asset('admin/js/tables-datatable.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables.net/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#datatable1').DataTable();
        });
    </script>
@endsection