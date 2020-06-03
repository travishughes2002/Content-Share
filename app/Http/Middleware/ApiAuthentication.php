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
        
        // $api_keys = compact('api_keys');

        // echo $api_keys;

        // dd($api_keys);

        
        // if(in_array($token, $api_keys)){
        //     // return response()->json(['message' => '401, Unauthorized.'], 401);
        //     echo 'no work :(';
        // }
        
        echo '<p>';
        echo 'key:' . $token;
        echo '</p>';

        foreach($api_keys as $api_key) {
            echo '<p>';
            echo $api_key->key;
            echo '</p>';

            // if($token == $api_key->key){
            //     break;
            //     echo 'work';
            // }
            // else {
            //     return response()->json(['message' => '401, Unauthorized.'], 401);
            // }
        }

        // if($token != ''){
        //     return response()->json(['message' => 'Unauthorized.'], 401);
        // }
        return $next($request);
    }
}
