<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;

class CheckAuthorizedClients
{
    const CUSTOM_AUTH_HEADER = 'X-News-Connect-Auth-Token';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if forwarded request from CORS middleware is actually treated as CORS so we can proceed
        // NOTE: Library \Asm89\Stack\CorsService is explicitly installed with Barryvdh\Cors:0.11.0
        $isForwardedCorsRequest = app(\Asm89\Stack\CorsService::class)->isCorsRequest($request);
        if ($isForwardedCorsRequest) {
            return $next($request);  
        }
        // Check cases when Origin header is missing and we need to verify source by special header
        $hasCustomAuthorizationHeader = $request->headers->has(self::CUSTOM_AUTH_HEADER);
        if (!$hasCustomAuthorizationHeader) {
            return new Response('Unauthorized.', 401);
        }
        $customAuthHeaderValue = env('CUSTOM_AUTH_HEADER');
        if (!$customAuthHeaderValue) {
            return new Response('Unauthorized.', 401);
        }
        if ($request->headers->get(self::CUSTOM_AUTH_HEADER) !== $customAuthHeaderValue) {
            return new Response('Wrong authentication token.', 401);
        }
        return $next($request);
    }
}
