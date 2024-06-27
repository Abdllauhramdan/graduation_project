<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckUserBanStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response= $next($request);
        $user = Auth::user();

        if (Auth::check() && Auth::user()->is_band==true) {
            Auth::logout();
            return response()->json(['error' => 'User is banned.'], 401);
            
        }
    
        return $response;
    }
}
