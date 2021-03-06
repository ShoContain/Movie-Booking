<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'required|boolean'
        ]);
        
        $credentials = $request->only($request,'email','password');
        $remember = $request->only($request,'remember');

        if (!Auth::attempt($credentials,$remember)) {
            abort(Response::HTTP_UNAUTHORIZED, 'メールアドレス又はパスワードが違います。');
        }   
        
        return response()->json([
            'message' => "Logged In !"
        ],Response::HTTP_OK
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
