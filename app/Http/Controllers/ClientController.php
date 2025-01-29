<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    //

    public function register(){
        return view('client.register');
    }

    public function store (Request $request){
        $validation = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255|min:8',
        ]);

        $validation['password'] = Hash::make($validation['password']);

        Client::create($validation);

        return view('welcome');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Gunakan guard 'client' untuk autentikasi
    if (Auth::guard('client')->attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('client.dashboard');
    }

    // Jika login gagal
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

    public function loginIndex(){
        return view('client.login');
    }
}
