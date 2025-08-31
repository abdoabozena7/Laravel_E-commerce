<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * LoginRegisterController handles user authentication and dashboard display.
 *
 * It provides actions for rendering the registration and login forms,
 * storing new users, authenticating existing users, rendering the
 * dashboard with basic statistics, and logging out. The controller
 * leverages built‑in Laravel validation and authentication
 * mechanisms, as illustrated in the reference implementation【423668695464687†L137-L201】.
 */
class LoginRegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|in:male,female,other',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration completed, please login.');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Display the dashboard with statistics.
     */
    public function dashboard()
    {
        $user = auth()->user();
        $categoriesCount = \App\Models\Category::count();
        $productsCount = \App\Models\Product::count();
        $ordersCount = \App\Models\Order::count();

        $orders = \App\Models\Order::with('user')
                    ->latest()
                    ->take(5)
                    ->get();

        return view('dashboard', compact('user', 'categoriesCount', 'productsCount', 'ordersCount', 'orders'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}