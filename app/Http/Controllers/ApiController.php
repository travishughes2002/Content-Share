<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Apikeys;
use App\User;

class ApiController extends Controller
{
    /**
     * Constuct
     * 
     * This is called for all functions. Currently it exacutes a middleware to
     * check if the user is logged in.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('apiTest');
    }


    /**
     * Create API key.
     * 
     * This randomly generates an api key and stores it
     * as an entery in the database.
     */
    public function createApiKey(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string']
        ]);

        Apikeys::create([
            'name' => $request->name,
            'key' => Str::random(32),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/settings');
    }


    /**
     * Delete API Key
     * 
     * This will delete the specified api key.
     */
    public function deleteApiKey($id)
    {
        $apiKey = Apikeys::find($id);

        $apiKey->delete();

        return redirect('/settings');
    }


    public function apiTest() {
        echo 'working';
    }

}
