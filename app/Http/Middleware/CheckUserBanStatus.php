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
    //     $user = Auth::user();

    //     if ($user === null) {
    //         // إذا لم يكن المستخدم مسجلاً الدخول أو لم يتم العثور على المستخدم
    //         return response()->json(['error' => 'User not found.'], 404);
    //     }

    //     if ($user->is_band) {
    //         return response()->json(['error' => 'User is banned.'], 403);
    //     }

    //     return $next($request);
    }
}
