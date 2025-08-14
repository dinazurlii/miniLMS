<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    DB::table('users')->insert([
        'id' => DB::raw('nextval(\'"Capstone".users_id_seq\'::regclass)'),
        'name' => $request->name,
        'email' => $request->email,
        'email_verified_at' => null,
        'password' => Hash::make($request->password),
        'remember_token' => '',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Auto login setelah register
    $user = DB::table('users')->where('email', $request->email)->first();
    session(['user' => $user]);

    return redirect()->route('dashboard');
}


    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = DB::table('users')->where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        session(['user' => $user]);
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
}
}
