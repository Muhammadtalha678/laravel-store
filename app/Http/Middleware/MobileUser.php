<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MobileUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $generateToken = 'eyJpdiI6IkdaSjQvblhZcHZVVzdBTGx2ZFY0RFE9PSIsInZhbHVlIjoicXhwSTR1cmdEbmFuWXA2bWd6aSttUT09IiwibWFjIjoiYjUxODQ2MjZhZmE5MDE1ZDUxM2NmZjVkMDVlMjA1OTBjM2FjYjUxZGVlMTNlZTZmNDhiOWQ2ZmRiY2Y5NzgyMCIsInRhZyI6IiJ9';
        $requestToken = $request->bearerToken();
        if ($requestToken == $generateToken) {
            return $next($request);
            
        }

        return response()->json(['error' => 'Unauthorized Access'], 401);
        // abort('403','Unauthorized Access');

    }
}
