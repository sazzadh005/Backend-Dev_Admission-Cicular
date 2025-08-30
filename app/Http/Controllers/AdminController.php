<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Portal;
use App\Models\Application;  

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
       $users = User::all();
        $circulars = Portal::all();
        $applications = Application::with(['user', 'portal'])->latest()->get();

        return view("admin.dashboard", compact("users", "circulars", "applications"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to the intended page or dashboard
            if (auth()->user()->role === 'user') {
                return redirect()->route('users.show', [ auth()->id()])->with('success', 'You are logged in as a user.');
            } else {
            return redirect()->intended('admin/dashboard');
            }
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ])->onlyInput('email','password');
    }

     public function logout(Request $request)
    {
        Auth::logout(); // This logs out the user

        $request->session()->invalidate(); // This invalidates the current session

        $request->session()->regenerateToken(); // This regenerates the CSRF token

        return redirect('/'); // Redirects to the home page after logging out
    }

    public function reset(){
        return view('auth.password');
    }

    public function store(Request $request){
        // ✅ Validate fields
    $validated = $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8|confirmed', 
        // "confirmed" automatically checks password_confirmation
    ]);

    // ✅ Update password
    User::where('email', $validated['email'])->update([
        'password' => bcrypt($validated['password']),
    ]);

    return redirect('/')->with('success', 'Password reset successfully. You can now login with your new password.');
}
}
