@extends('master.user')

@section('content')
<!-- text page-->
<section class="padding-small">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="block">
                    <div class="block-header">
                        <h5>Admin Login</h5>
                    </div>
                    <div class="block-body">
                        <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1 pl-0 pr-0">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                </div>
                                <div class="col-md-11 pl-0">
                                    <label> {{ __('Remember Me') }} </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                                <a class="btn btn-link pull-right" href="{{ route('admin.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
