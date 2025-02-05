<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin'); // Arahkan ke Filament
            }elseif($user->role === 'teacher'){
                return redirect('/teacher'); // Arahkan ke Teacher User
            }elseif($user->role === 'mahasiswa'){
                return redirect('/dashboard');
            }elseif($user->role === 'umum'){
                return redirect('/dashboard');
            }elseif($user->role === 'user'){
                return redirect('/dashboard');
            }
            return redirect('/dashboard'); // Arahkan ke dashboard user biasa
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:mahasiswa,umum'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        Auth::login($user);

        if ($user->role === 'teacher') {
            return redirect('/teacher');
        }elseif($user->role === 'mahasiswa'){
            return redirect('/dashboard');
        }elseif($user->role === 'umum'){
            return redirect('/dashboard');
        }elseif($user->role === 'user'){
            return redirect('/dashboard');
        }
        
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}