<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('pegawai.portal');
        }

        return view('login');
    }

    /**
     * Proses autentikasi login (Username / NIP).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Username atau NIP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginInput = trim($credentials['login']);
        $password = $credentials['password'];

        // Cari berdasarkan username atau NIP
        $user = User::where('username', $loginInput)
            ->orWhere('nip', $loginInput)
            ->orWhere('email', $loginInput)
            ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors(['login' => 'Username/NIP atau Password yang Anda masukkan tidak sesuai.']);
        }

        if (!$user->is_active) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors(['login' => 'Akun Anda saat ini dinonaktifkan. Silakan hubungi Administrator.']);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->route('pegawai.portal');
    }

    /**
     * Halaman portal pegawai sementara.
     */
    public function pegawaiPortal()
    {
        return view('pegawai.portal');
    }

    /**
     * Proses keluar dari sistem.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda telah berhasil keluar dari sistem.');
    }
}
