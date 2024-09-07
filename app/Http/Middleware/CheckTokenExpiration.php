<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::guard('sanctum')->check()) {
            return $next($request);
        }

        // If the token is expired or unauthenticated, return a JSON response
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Token expired or unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
