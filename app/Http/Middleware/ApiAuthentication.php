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

        $apiKeys = Apikeys::all();

        echo $apiKeys->key;

        for($i = 0; $i <= count($apiKeys); $i++) {
            if($apiKeys->key == $token) {
                echo 'Works';
            break;
            }
        }
      
        // dd($api_keys);

        // echo '|';
        // echo 'ApiKeys Raw:' . $apiKeys;
        // echo '|';
        
        // echo '|';
        // echo 'token:' . $token;
        // echo '|';

        // foreach($apiKeys as $apiKey) {
        //     echo '|';
        //     echo 'keys:' . $apiKey->key;
        //     echo '|';

        //     if($token == $apiKey->key){
        //         break;
        //         echo 'work';
        //     }
        //     else {
        //         return response()->json(['message' => '401, Unauthorized.'], 401);
        //     }
        // }

        // if($token != ''){
        //     return response()->json(['message' => 'Unauthorized.'], 401);
        // }
        return $next($request);
    }
}
