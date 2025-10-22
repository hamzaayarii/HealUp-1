<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access admin area.');
        }

        // Check if user has admin role
        $user = auth()->user();

        // Check if user has admin role (assuming you have a role field or relationship)
        if (!$this->isAdmin($user)) {
            abort(403, 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }

    /**
     * Check if user is admin.
     */
    private function isAdmin($user): bool
    {
        // Use the helper method from User model
        return $user->isAdmin();
    }
}
