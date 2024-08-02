<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->roles[0]->pivot->role_id == 1){ //admin
            return $next($request);
        }
        
        return redirect()->route('post.index')->withErrors('Anda tidak diperbolehkan untuk melakukan aksi ini.');
    }
}
