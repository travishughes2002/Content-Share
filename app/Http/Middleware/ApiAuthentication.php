<?php

namespace App\Http\Middleware;


use Closure;
use App\Apikeys;

class ApiAuthentication
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
        $token = $request->header('APP_KEY');

        $api_keys = Apikeys::all();

        foreach($api_keys as $api_key) {
            if($token != $api_key){
                return response()->json(['message' => '401, Unauthorized.'], 401);
            }
        }

        if($token != ''){
            return response()->json(['message' => 'Unauthorized.'], 401);
        }
        return $next($request);
    }
}
