<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Master_04_Dosen;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index(){
        return view('login', [
            'title' => 'Login',
            'isLoginView' => true
        ]);
    }

    public function authenticate(LoginPostRequest $request){
        $validated = $request->validated();
        $credentials = $validated;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->roles[0]->name == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else if (Auth::user()->roles[0]->name == 'dosen') {
                return redirect()->intended('/dosen/mata-kuliah');
            } else {
                return redirect()->intended('/kaprodi/kurikulum');
            }
        }

        return back()->with('loginError', 'Login gagal. Kode / kata sandi salah.');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'kode';
    }
}
