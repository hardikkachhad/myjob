<?php

namespace App\Http\Controllers\front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    // Register file include
    public function register()
    {
        return view('frontent.account.registation');
    }

    // Register store file
    public function registerstore(Request $request)
    {
        $validalitor = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:3|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        if ($validalitor->passes()) {
            $user = new User;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            session()->flash('success', 'Register Create SuccessFully.');
            return response()->json([
                'status' => true,
                'errors' => $validalitor->errors()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validalitor->errors()
            ]);
        }
    }

    // login file include

    public function login()
    {
        return view('frontent.account.login');
    }
    public function dologin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                return redirect()->route('account.accountprofile');
            } else {
                return redirect()->route('account.login')->with('error', 'Email or password is incorrect');
            }
        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => Hash::make(rand(100000, 999999))]);
        }

        Auth::login($user);
        return redirect()->route('account.accountprofile');
    }

    // account profile 
    public function accountprofile()
    {
        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        return view('frontent.account.profile', compact('user'));
    }


    public function updateprofile(Request $request)
    {
        $validator = Validator::make($request->all(), []);
    }

    // User LogOut
    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
