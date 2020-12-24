<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\ApiKey;

/**
 * ApiController
 * 
 * This controller is responsable for the general managment of api keys
 * like creating, editing, deleting etc.
 */
class ApiController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Create Key
     * 
     * Suggested by the name, this will create a key using the
     * $request data
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
        ]);
        
        // Generate a random 30 charecter string
        $key = Str::random(30);
        
        // This creates the database entery.
        ApiKey::create([
            'name' => request('name'),
            // 'key' => Hash::make($key), // Hash the string so it's not stored in plain text.
            'key' => Crypt::encryptString($key),
            'user_id' => auth()->user()->id
        ]);
        
        // Return to settings with the new key.
        // return redirect('settings');
        return redirect('settings')->with('success', $key);
    }

    /**
     * Delete Key
     * 
     * This deletes the key with the specified ID.
     */
    public function delete($id)
    {
        $key = ApiKey::find($id);

        $key->delete();
        return redirect('/settings');
    }
}
