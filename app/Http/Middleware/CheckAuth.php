<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        // Check session expiry for user role
        if (session('role') === 'user') {
            // Check database login_expiry
            $user = User::find(session('user_id'));

            if (!$user) {
                session()->flush();
                return redirect()->route('login')->with('error', 'User not found.');
            }

            // If login_expiry is null, user has been logged out by admin
            if (is_null($user->login_expiry)) {
                session()->flush();
                return redirect()->route('login')->with('error', 'Your access has been revoked by admin.');
            }

            // Check if login_expiry has passed
            if (now()->greaterThan($user->login_expiry)) {
                $user->login_expiry = null;
                $user->save();
                session()->flush();
                return redirect()->route('login')->with('error', 'Session expired. Please login again.');
            }
        }

        return $next($request);
    }
}