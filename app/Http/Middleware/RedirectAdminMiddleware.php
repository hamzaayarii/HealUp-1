<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            // Allow profile management routes for admins
            $allowedRoutes = [
                'admin/*',
                'logout',
                'user/profile-information',
                'user/password',
                'user/two-factor-authentication',
                'user/profile-photo',
                'user/other-browser-sessions',
                'user/profile',
                'current-user',
                'livewire/*'
            ];
            $isAllowed = false;
            foreach ($allowedRoutes as $route) {
                if ($request->is($route)) {
                    $isAllowed = true;
                    break;
                }
            }

            // If admin is trying to access front office routes, redirect to admin dashboard
            if (!$isAllowed) {
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
