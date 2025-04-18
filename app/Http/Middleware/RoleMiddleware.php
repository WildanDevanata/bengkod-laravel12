<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        $user = Auth::user();

        if($user->role !== $role){
            // Redirect based on user's actual role
            if ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            } elseif ($user->role === 'pasien') {
                return redirect()->route('pasien.dashboard');
            } else {
                return redirect('/login');
            }
        }

        return $next($request);
    }
}