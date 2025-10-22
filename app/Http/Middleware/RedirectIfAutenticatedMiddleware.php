<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAutenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case "admin":
                    return redirect()->route('admin.dashboard');
                case 'pembimbing':
                    return redirect()->route('pembimbing.dashboard');
                case 'siswa':
                    return redirect()->route('siswa.dashboard');        
            }
        }

        return $next($request);
    }
}
