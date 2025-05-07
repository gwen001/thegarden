<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $csp = $this->buildCspPolicy();

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }

    private function buildCspPolicy(): string
    {
        return "default-src 'self'; " .
               "style-src 'self' 'unsafe-inline'; " .
               "script-src 'self' https://*.offsec.tools; " .
               "object-src 'none';";
    }
}
