<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\TodoController;

// Login Page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register Page
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Register Action
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Auto login
    $user = DB::table('users')->where('email', $request->email)->first();
    session(['user' => $user]);

    return redirect()->route('dashboard');
})->name('register.post');

// Login Action
Route::post('/login', function (Request $request) {
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
})->name('login.post');

// Dashboard (Login Required)
Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    $user = session('user');
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/podomoro', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return view('podomoro');
});

// Logout
Route::get('/logout', function () {
    session()->forget('user');
    return redirect()->route('login');
})->name('logout');

Route::get('/todo', [TodoController::class, 'index'])->name('todo');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::patch('/todo/{id}/toggle', [TodoController::class, 'toggle'])->name('todo.toggle');

Route::get('/calculator', [App\Http\Controllers\CalculatorController::class, 'index'])->name('calculator');




