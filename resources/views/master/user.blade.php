<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.user.head')
    <body>
        <!-- navbar-->
        @include('layouts.user.nav')
        
        @yield('content')

        @include('layouts.user.footer')
        <!-- JavaScript files-->
        @include('layouts.user.scripts')
    </body>
</html>
