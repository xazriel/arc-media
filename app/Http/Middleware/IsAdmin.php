<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    // Jika member coba masuk ke area admin, lempar ke halaman utama
    return redirect('/')->with('error', 'Hanya Admin yang bisa mengakses halaman tersebut.');
}
}