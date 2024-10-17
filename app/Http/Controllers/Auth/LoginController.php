<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // return redirect()->route('products.index');
            return response()->json([
                'success' => 'true',
                'message' => 'Logged in Successfully',
                'redirect' => route('products.index'),
            ]);
        } 
            return response()->json([
                'success' => 'false',
                'message' => 'Invalid credentials',
            ]);
        

        

        //  return back()->withErrors(['email' => 'Invalid credentials']);
      
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
