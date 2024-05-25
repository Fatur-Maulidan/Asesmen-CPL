<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginPostRequest;

class AuthController extends Controller
{
    public function index(){
        return view('login', [
            'title' => 'Login',
            'isLoginView' => true
        ]);
    }

    public function authenticate(LoginPostRequest $request){
        $credentials = $request->only('NIP','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role == 'Kaprodi' ? 
                redirect()->intended('/kaprodi/kurikulum') : 
                redirect()->intended('/dosen/mata-kuliah');
            return $role;
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
