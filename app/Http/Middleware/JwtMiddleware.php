<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization'))
		{
			$token = explode(' ', $request->header('Authorization'))[1];
            try {
			    $payload = (array) JWT::decode($token, config('app.token_secret'), array('HS256'));
            } catch(Exception $e) {
                return response()->json(['message' => 'Could not parse token']);
            }
            
			if ($payload['exp'] < time())
			{
				return response()->json(['message' => 'Token has expired']);
			}
			$request['user'] = $payload;
			return $next($request);
		}
		else
		{
			return response()->json(['message' => 'Please make sure your request has an Authorization header'], 401);
		}
    }
}
