<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
          return response()->json(['error' => 'Invalid token'])->setStatusCode(401, 'Unauthorized');
        }
          
        $accessToken = PersonalAccessToken::findToken($token);
        
        if (!$accessToken) {
          return response()->json(['error' => 'Invalid token'])->setStatusCode(401, 'Unauthorized');
        }

        if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
          $accessToken->delete();
          return response()->json(['error' => 'Token expired'])->setStatusCode(401, 'Unauthorized');
        }

        return $next($request);
    }
}
