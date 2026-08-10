<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin bypass semua restriction (akses penuh)
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        if (!$user->hasRole($roles)) {
            // Redirect sesuai role milik user saat ini
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki hak akses ke area tersebut.');
        }

        return $next($request);
    }
}
