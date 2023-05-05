<?php
// Middleware pour le client
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->isClient()) {
            return $next($request);
        }
    
        return redirect('/')->with('error', 'Unauthorized access');
    }

}