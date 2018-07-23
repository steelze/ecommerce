<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewProfile(Request $request)
    {
        return view('user.profile');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->old_password])){
            $user = User::find(Auth::user()->id)->update(['password' => Hash::make($request->password)]);
            return redirect()->back()->with(['msg' => 'Password Changed']);
        }
        return redirect()->back()->withErrors(['old_password' => 'Invalid Password']);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        User::find(Auth::user()->id)->update($request->all());
        return redirect()->back()->with(['msg' => 'Profile Updated']);
    }
}
