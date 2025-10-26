<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is logged in
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        // Check if user role is in allowed roles
        $userRole = session('role');
        if (!in_array($userRole, $roles)) {
            // Redirect based on user's actual role
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($userRole === 'kitchen') {
                return redirect()->route('dapur.dashboard');
            } elseif ($userRole === 'user') {
                return redirect()->route('home');
            }

            return redirect()->route('login');
        }

        return $next($request);
    }
}