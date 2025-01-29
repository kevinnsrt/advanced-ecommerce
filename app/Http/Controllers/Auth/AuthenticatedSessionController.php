<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Melakukan autentikasi pengguna
    $request->authenticate();

    // Regenerasi session setelah login berhasil
    $request->session()->regenerate();

    // Cek role pengguna dan arahkan ke halaman yang sesuai
    if (auth()->user()->role === 'admin') {
        // Jika role adalah admin, arahkan ke dashboard admin
        return redirect()->route('dashboard'); // Ganti 'admin.dashboard' dengan rute dashboard admin yang sesuai
    }

    // Jika role adalah user atau lainnya, arahkan ke halaman user
    return redirect()->route('user.dashboard'); // Ganti 'user.dashboard' dengan rute dashboard user yang sesuai
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
