<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    // public function __construct() {
    //     $this->middleware('guest');
    // }

    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if (auth()->user()->role == 'admin') {
                    return redirect()->intended('admin/dashboard')->with(['success' => 'Anda berhasil login']);
                } else {
                    return redirect()->intended('/')->with('success' , 'Anda berhasil login');
                }
            } else {
                return back()->with('error', 'Username atau Password tidak sesuai');
            }

            throw ValidationException::withMessages([
                'username' => 'Your provide credentials does not match our records',
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Username atau Password tidak sesuai');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
