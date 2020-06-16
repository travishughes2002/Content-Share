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

        // for(i == 0; i < yourarray.length; i++){
        //     if(yourarray[i].key == yourcomparevarible){
        //     //   Do something if its the same
        //     }
        // }


        for($i = 0; $i <= count($apiKeys->key); $i++) {
            echo 'yay work';
        }


        // for ($x = 0; $x <= count($apiKeys); $x++) {
        //     echo "The number is: $x <br>";
        // }
      



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
