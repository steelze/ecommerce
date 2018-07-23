<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.admin.head')    
    <body>
        <div class="page">
            <!-- Main Navbar-->
            @include('layouts.admin.nav')    
            <div class="page-content d-flex align-items-stretch"> 
                @include('layouts.admin.aside')    
                    <div class="content-inner">
                        @yield('content')
                        
                        <!-- Page Footer-->
                        <footer class="main-footer">
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                <p>Hub &copy; 2017-{{ \Carbon\Carbon::now()->format('Y') }}</p>
                                </div>
                                <div class="col-sm-6 text-right">
                                <p>Version 1.4.3</p>
                                </div>
                            </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        <!-- JavaScript files-->
        @include('layouts.admin.scripts')
    </body>
</html>