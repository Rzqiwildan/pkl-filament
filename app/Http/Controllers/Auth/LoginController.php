<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\ValidationException;

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
        
        // Gunakan pengecekan langsung ke kolom email_verified_at
        if (is_null($user->email_verified_at)) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Anda perlu memverifikasi email terlebih dahulu. Silakan cek email Anda.',
            ])->with('resend', true);
        }
        
        // Pengecekan role
        if ($user->role === 'admin') {
            return redirect('/admin');
        } elseif($user->role === 'teacher') {
            return redirect('/teacher');
        } elseif($user->role === 'mahasiswa') {
            return redirect('/dashboard');
        } elseif($user->role === 'umum') {
            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Your account or password is incorrect.',
    ]);
}
    
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:mahasiswa,umum'
            ], [
                // Custom error messages
                'email.unique' => 'Email sudah terdaftar, Silakan gunakan email lain.',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            if ($user->role === 'umum') {
                DB::table('umums')->insert([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Kirim email verifikasi
            event(new Registered($user));
            
            Auth::login($user);
            
            // Redirect ke halaman verifikasi email
            return redirect()->route('verification.notice');
            
        } catch (ValidationException $e) {
            // Catch validation errors and redirect with specific message
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Catch other possible errors
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}