<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\ApiKey;

class AuthenticateViaApi
{
    /**
     * This handles incomming requests by checks to see if the
     * submitted API key is in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $headerKey = $request->header('Api-Key');
        $apiKeys = Apikey::all();
        
        // Compare each Api key to the submitted key, return if true
        foreach($apiKeys as $key) {
            // if(Hash::check($headerKey, $key->key))
            // {
            //     return $next($request);
            // }
            if($headerKey == Crypt::decryptString($key->key))
            {
                return $next($request);
            }
        }
        
        return response()->json(['message' => 'unauthorized'. Crypt::encryptString($headerKey), 'status' => '401'], 401);
    }
}
