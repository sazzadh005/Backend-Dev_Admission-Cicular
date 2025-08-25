<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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
    }else if(auth()->check() && auth()->user()->role === 'user') {
        return redirect()->route('users.show', [ auth()->id()])->with('success', 'You are logged in as a user.');
    }

    // Redirect to the 'users.show' route, passing the user's ID as a parameter.
    return redirect()->route('login')
        ->with('error', 'You do not have admin access.');
}

}