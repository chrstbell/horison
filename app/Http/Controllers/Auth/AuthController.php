<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showUserLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Harap isi username/email.',
            'password.required' => 'Harap isi password.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)
            ->where('password', $password)
            ->first();

        if ($user) {
            // Store user data in session
            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'room_number' => $user->room_number ?? null
            ]);

            // Set session lifetime for user role (30 minutes)
            if ($user->role == 'user') {
                $user->login_expiry = now()->addMinutes(30);
                $user->login_time = now();
                $user->save();
                // Set session timeout for user role
                session(['expires_at' => now()->addMinutes(30)->timestamp]);
            }

            // Redirect based on role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role == 'kitchen') {
                return redirect()->route('dapur.dashboard');
            }

            if ($user->role == 'user') {
                return redirect()->route('home');
            }
        }

        // Kredensial salah
        return back()->withInput()->withErrors([
            'username' => 'Username/email atau password salah!',
        ]);
    }

    public function logoutPage()
    {
        return view('auth.logout');
    }

    public function logout()
    {
        // Get user from session before flushing
        $userId = session('user_id');
        $userRole = session('role');

        // If user is of 'user' role, clear their login_expiry and login_time
        if ($userId && $userRole === 'user') {
            $user = User::find($userId);
            if ($user) {
                $user->login_expiry = null;
                $user->login_time = null;
                $user->save();
            }
        }

        session()->flush();
        return redirect(route('login'));
    }
}
