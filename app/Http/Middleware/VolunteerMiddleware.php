<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VolunteerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user is volunteer and has approved volunteer profile
        if ($user->isVolunteer() && $user->volunteer && $user->volunteer->status === 'approved') {
            return $next($request);
        }

        // Admin and super admin can also access volunteer areas
        if ($user->isAdmin()) {
            return $next($request);
        }

        abort(403, 'You must be an approved volunteer to access this area.');
    }
}