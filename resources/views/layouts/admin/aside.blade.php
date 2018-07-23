<!-- Side Navbar -->
<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="title">
            <h1 class="h4">{{ Auth::user()->name }}</h1>
            <p>{{ Auth::user()->email }}</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="active"><a href="index-2.html"> <i class="icon-home"></i>Home </a></li>
        <li><a href="#categoryDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Category</a>
            <ul id="categoryDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('category.index')}}">All Categories</a></li>
                <li><a href="{{ route('category.create')}}">Add Category</a></li>
            </ul>
        </li>
        <li><a href="#subCategoryDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>SubCategory</a>
            <ul id="subCategoryDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('subcategory.index')}}">All SubCategories</a></li>
                <li><a href="{{ route('subcategory.create')}}">Add SubCategory</a></li>
            </ul>
        </li>
        <li><a href="#brandDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Brand</a>
            <ul id="brandDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('brand.index')}}">All Brands</a></li>
                <li><a href="{{ route('brand.create')}}">Add Brand</a></li>
            </ul>
        </li>
        <li><a href="#productDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Product</a>
            <ul id="productDropdown" class="collapse list-unstyled ">
                <li><a href="{{ route('product.index')}}">All Products</a></li>
                <li><a href="{{ route('product.create')}}">Add Product</a></li>
            </ul>
        </li>
    </ul>
    <span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li> <a href="#"> <i class="icon-picture"></i>Demo </a></li>
    </ul>
</nav>