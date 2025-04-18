<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if($user->role == 'dokter'){
                return redirect()->route('dokter.dashboard');
            }elseif($user->role == 'pasien'){
                return redirect()->route('pasien.dashboard');
            }else {
                return redirect()->route('login');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function showRegister()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|string|max:50|unique:users',
        'email' => 'required|email|max:50|unique:users',
        'password' => 'required|string|confirmed|min:6',
    ]);

    $user = User::create([
        'nama' => $validated['nama'],
        'alamat' => $validated['alamat'],
        'no_hp' => $validated['no_hp'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'pasien',
    ]);

    Auth::login($user);

    return redirect()->route('pasien.dashboard');
}

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}