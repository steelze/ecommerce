<header class="header" id="header-refresh">
    <nav class="navbar navbar-expand-lg">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <form action="#">
                <div class="form-group">
                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                    <button type="submit" class="submit"><i class="icon-search"></i></button>
                </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">  
            <!-- Navbar Header  -->
            <a href="#" class="navbar-brand"><img src="{{asset('/img/logo.png')}}" alt="..."></a>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            <!-- Navbar Collapse -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a>
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">Categories<i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        @foreach($categories as $category)
                                        <div class="col-lg-3"><strong class="text-uppercase">{{ $category->name }}</strong>
                                            <ul class="list-unstyled">
                                                @foreach($category->subCategory as $subcategory)
                                                    <li><a href="#">{{ $subcategory->name}}</a></li>
                                                @endforeach
                                            </ul>
                                            <strong class="text-uppercase">Shop</strong>
                                            <ul class="list-unstyled">                                                   
                                                <li><a href="#">Product detail</a></li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row services-block">
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-secure-shield text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Secure Payment</span><small>Secure Payment</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="#" class="product-image"><img src="{{ asset('/img/shirt.png') }}" alt="..." class="img-fluid"></a>
                                    <h6 class="text-uppercase product-heading"><a href="detail.html">Lose Oversized Shirt</a></h6>
                                    <ul class="rate list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o text-primary"></i></li>
                                    </ul><strong class="price text-primary">$65.00</strong><a href="#" class="btn btn-template wide">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @auth
                    <li class="nav-item"><a href="{{ route('view.profile',[
                        'email' => Auth::user()->email,
                        'logged_in' => 'true',  
                        'name' => Auth::user()->name]) }}" class="nav-link">Profile</a>
                    <li class="nav-item"><a href="#" class="nav-link">My Orders</a>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link logout">
                            <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                    @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a>
                    <li class="nav-item"><a href="{{ route('admin.login') }}" class="nav-link">Admin Login</a>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endauth
                </ul>
                <div class="right-col d-flex align-items-lg-center flex-column flex-lg-row">
                <!-- Search Button-->
                <div class="search"><i class="icon-search"></i></div>
                <!-- Cart Dropdown-->
                <div class="cart dropdown show"><a id="cartdetails" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="icon-cart"></i>
                    <div class="cart-no">{{ session()->has('cart') ? session('cart')->totalQty : 0 }}</div></a><a href="javascript:void(0)" class="text-primary view-cart">View Cart</a>
                        <div aria-labelledby="cartdetails" class="dropdown-menu">
                            @if(session()->has('cart') && session('cart')->totalQty > 0)
                            <!-- cart item-->
                            <div class="dropdown-item cart-product">
                                @foreach(session('cart')->items as $item)
                                    <div class="d-flex align-items-center">
                                        <div class="details d-flex justify-content-between">
                                        <div class="text"> <a href="javascript:void(0)"><strong>{{ $item['item']['name'] }}</strong></a><small>Quantity: {{ $item['qty'] }} </small><span class="price">&#8358;{{ number_format($item['price'], 2, '.', ',') }}</span></div><a href="javascript:void(0)" class="delete" onclick="removeSingleFromCart({{ $item['item']['id'] }})"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- total price-->
                        <div class="dropdown-item total-price d-flex justify-content-between"><span>Total</span><strong class="text-primary">
                            &#8358;{{ number_format(session('cart')->totalPrice, 2, '.', ',') }}
                        </strong></div>
                            <!-- call to actions-->
                            <div class="dropdown-item CTA d-flex"><a href="{{ route('view.cart') }}" class="btn btn-template wide">View Cart</a><a href="{{ route('user.checkout') }}" class="btn btn-template wide">Checkout</a></div>
                            @else
                                <div class="dropdown-item cart-product">
                                    <div class="d-flex align-items-center">
                                        <div class="details d-flex justify-content-between">
                                            <div class="text"><strong>No Item in Cart</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>