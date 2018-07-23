@extends('master.user')

@section('content')
<!-- text page-->
<section class="padding-small">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="block">
                    <div class="block-header">
                        <h5>Register</h5>
                    </div>
                    <div class="block-body">
                        <p class="text-center">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Already have an account? Login in here') }}
                            </a>
                        </p>
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="icon-profile"></i> Register</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection