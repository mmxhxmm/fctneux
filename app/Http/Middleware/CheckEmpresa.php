<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip check for page 1
        if ($request->routeIs('empresa-form-1')) {
            return $next($request);
        }

        // Redirect to page 1 if no empresa_draft exists
        if (!session()->has('empresa_draft')) {
            return redirect()->route('empresa-form-1');
        }

        return $next($request);
    }
}
