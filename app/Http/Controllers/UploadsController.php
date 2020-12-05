<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;

class UploadsController extends Controller
{
    /**
     * Store
     * 
     * This stores the inputed content and adds a entery into the database.
     */
    public function store(Request $request)
    {
        // This checks the inputed data to make sure its vaid. It checks if theres been
        // anything inputed then makes sure its an image.
        $validatedData = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,gif,jpg'],
            'video' => ['required', 'video', 'mimes:mp3,mp4,avi,ogg,wmv']
        ]);
        
        // This stores the image. It takes the $request (inputed data) and stores it in
        // the image disk under the user id.
        if($request->image)
        {
            $contentPath = $request->image->store('images/'.auth()->user()->id);
        }
        else
        {
            $contentPath = $request->video->store('videos/'.auth()->user()->id);
        }
        
        //$slug = str_replace(array('.jpeg', '.png', '.gif', '.jpg', 'images/', auth()->user()->id . '/'), '', $imagePath);
        
        // This creates the database entery.
        Images::create([
            'pathname' => $contentPath,
            'slug' => Str::random(10),
            'user_id' => auth()->user()->id
        ]);
        
        return redirect('/upload');
    }
}
