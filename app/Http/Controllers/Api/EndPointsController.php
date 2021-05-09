<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Uploads;
use App\Models\ApiKey;

/**
 * EndPointsController
 * 
 * This controller contains all the usable API endpoints.
 */
class EndPointsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.api')->except('info');
    }

    
    /**
     * Info
     * 
     * This is a test page that will display the status and other information about the API.
     */
    public function info()
    {
        return response()->json(['name' => 'Content Share', 'status' => '200'], 200);
    }


    /**
     * Store Uploads
     * 
     * This stores the submitted file and stores an entery in the database.
     */
    public function storeUpload(Request $request)
    {
        $userID = null;

        // This gets the user ID assosiated with the API key.
        // Todo this we must first find the maching key in the database and then
        // get it's assosiated row (theres probably a better way of doing this
        // But until I figure out how it will stay as this spegetti mess).
        foreach(ApiKey::all() as $key) 
        {
            if($request->header('Api-Key') == Crypt::decryptString($key->key))
            {
                $userId = ApiKey::all()->where('key', $key->key)->pluck('user_id'); // Query database for user_id
                $userId = str_replace(array('[', ']'), '', $userId); // Remove [] from varible.
            }
        }

        // This checks the inputed data to make sure its vaid. It checks if theres been
        // anything inputed then makes sure its an image.
        $validatedData = $request->validate([
            'file' => ['required', 'mimes:jpeg,png,gif,jpg,mp3,mp4,avi,ogg,wmv']
        ]);
        
        // This stores the image. It takes the $request (inputed data) and stores it in
        // the image disk under the user id.
        $filePath = $request->file->store('public/files/' . $userId);

        $slug = Str::random(10);
        
        // This creates the database entery.
        Uploads::create([
            'path_name' => str_replace('public/', '', $filePath),
            'slug' => $slug,
            'user_id' => $userId
        ]);
        
        return response()->json(['message' => 'upload successful', 'link' => URL::to('s/' . $slug), 'status' => '200'], 200);
    }
}
