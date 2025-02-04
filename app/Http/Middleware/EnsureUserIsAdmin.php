<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return redirect()->route('admin.login')->with('error', __('auth.login_required'));
        }

        // Check if the authenticated user is an admin
        if (!Auth::user()->is_admin) {
            // Log unauthorized access attempts
            Log::warning('Unauthorized access attempt by user: ' . Auth::id());

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            return redirect()->route('home')->with('error', __('You are not authorized'));
        }

        // If the user is an admin, proceed with the request
        return $next($request);
    }

}
