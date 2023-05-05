<?php

// Middleware pour l'admin
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('admin') !== true) {
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
    
}