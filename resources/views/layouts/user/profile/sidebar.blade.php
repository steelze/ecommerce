<div class="customer-sidebar col-xl-3 col-lg-4 mb-md-5">
    <div class="customer-profile"><a href="#" class="d-inline-block"><img src="{{ asset('img/person-3.jpg') }}" class="img-fluid rounded-circle customer-image"></a>
    <h5>{{ Auth::user()->name }}</h5>
    <p class="text-muted text-small">{{ Auth::user()->state }}, {{ Auth::user()->country }}</p>
    </div>
    <nav class="list-group customer-nav">
        <a href="customer-login.html" class="list-group-item d-flex justify-content-between align-items-center"><span><span class="fa fa-sign-out"></span>Log out</span></a>
    </nav>
</div>