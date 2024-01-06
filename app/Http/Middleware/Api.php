<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $apiKey);

        $apitoken = ['eyJpdiI6IkNIbVdtc0xXVHIvWEpraXpxTlBQc3c9PSIsInZhbHVlIjoiRk1JNXRBRHMvdGREOExjSUJVcG9jZz09IiwibWFjIjoiZmE0Nzk2YmIwZWI1MTJjZWU2NWIxYjg1YjI5ODk3NDU0YWY3MDkyNGQ4ZjZmNjMzOTQ1NjQ4MTQ2NjY4MmZlYSIsInRhZyI6IiJ9'];
        // var_dump(in_array($token, $apitoken));

        if (in_array($token, $apitoken)) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized Access'], 401);
        // abort(403, 'Unauthorized access');

        // Check if $apiKey is valid (e.g., compare it with a list of valid keys)
        // If valid, allow the request; otherwise, return 401 Unauthorized

    }
}
