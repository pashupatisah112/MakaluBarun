<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function adminLogin(Request $request){
        $credentials=$request->only('username','password');
        if(Auth::attempt($credentials)){
                $token=Str::random(80);
                Auth::user()->api_token=$token;
                Auth::user()->save();
                $auth_user=Auth::user();
                return response()->json(['token'=>$token,'admin'=>$auth_user],203);
        }
        return response()->json(['status'=>'Email or Password is wrong.'],403);
    }
}
