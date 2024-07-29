<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:3|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User Create SucessFully',
                'User' => $user
            ]);
        }else{
            return response()->json([
                'success' => true,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function dologin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => ' validator error'
            ]);
        }
        if (Auth::attempt(['email' => $request->email,'password' => $request->password])) {
            $user = auth::user();
            return response()->json([
                'status' => true,
                'message' => 'User Login SuccessFully.',
                'token' => $user->createToken('User Token')->plainTextToken,
                'token_type' => 'bearer'
            ],200);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'Email Or Password is Incorrenct'
            ],401);
        }
    }
    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->delete();

        
        return response()->json([
            'status' =>  true,
            'message' => 'User Delete SuccessFully',
            'errors' => $user
        ]);
    }
}
