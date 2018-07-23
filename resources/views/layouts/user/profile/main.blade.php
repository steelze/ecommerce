<div class="col-lg-8 col-xl-9 pl-lg-3">
    <div class="block-header mb-5">
        <h5>Change password </h5>
    </div>
    @if(session('msg'))
        <p class="text-success text-center">{{ session('msg') }}</p> 
    @endif
    <form class="content-block" method="POST" action="{{ route('change.user.password') }}">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password_old" class="form-label">Old password</label>
                    <input id="password_old" type="password" name="old_password" class="form-control">
                </div>
                @if($errors->has('old_password'))
                    <div class="text-danger pl-3">
                        <small><strong>{{ $errors->first('old_password') }}</strong></small>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
            <div class="form-group">
                <label for="password_1" class="form-label">New password</label>
                <input id="password_1" type="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <div class="text-danger pl-3">
                        <small><strong>{{ $errors->first('password') }}</strong></small>
                    </div>
                @endif
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label for="password_2" class="form-label">Retype new password</label>
                <input id="password_2" type="password" name="password_confirmation" class="form-control">
            </div>
            </div>
        </div>
        <!-- /.row-->
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Change password</button>
        </div>
    </form>
    <div class="block-header mb-5">
        <h5>Personal details</h5>
    </div>
    <form class="content-block" method="POST" action="{{ route('update.user.profile') }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
                    @if($errors->has('name'))
                        <div class="text-danger pl-3">
                            <small><strong>{{ $errors->first('name') }}</strong></small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    @if($errors->has('email'))
                        <div class="text-danger pl-3">
                            <small><strong>{{ $errors->first('email') }}</strong></small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.row-->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="state" class="form-label">State</label>
                    <select id="state" class="form-control" name="state">
                        <option value="Lagos">Lagos</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="country" class="form-label">Country</label>
                    <select id="country" class="form-control" name="country">
                        <option value="Nigeria">Nigeria</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="street" class="form-label">Street</label>
                    <input id="street" type="text" class="form-control" name="street" value="{{ Auth::user()->street ? Auth::user()->street : old('street') }}">
                </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label for="phone" class="form-label">Telephone</label>
                <input id="phone" type="text" name="tel" class="form-control"value="{{ Auth::user()->tel ? Auth::user()->tel : old('tel') }}">
            </div>
            </div>
            <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
            </div>
        </div>
    </form>
</div>