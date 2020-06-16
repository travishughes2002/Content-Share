<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Images;
use App\User;
use App\Domains;

class UploadController extends Controller
{
    /**
     * Constuct
     * 
     * This is called for all functions. Currently it exacutes a middleware to
     * check if the user is logged in.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Store
     * 
     * This stores the inputed image and adds a entery into the database.
     */
    public function store(Request $request)
    {
        // This checks the inputed data to make sure its vaid. It checks if theres been
        // anything inputed then makes sure its an image.
        $validatedData = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,gif,jpg']
        ]);
        
        // This stores the image. It takes the $request (inputed data) and stores it in
        // the image disk under the user id.
        $imagePath = $request->image->store('images/'.auth()->user()->id);
        
        //$slug = str_replace(array('.jpeg', '.png', '.gif', '.jpg', 'images/', auth()->user()->id . '/'), '', $imagePath);
        
        // This creates the database entery.
        Images::create([
            'pathname' => $imagePath,
            'slug' => Str::random(10),
            'user_id' => auth()->user()->id
        ]);
        
        return redirect('/home');
    }


    /**
     * View Uploads
     * 
     * This displays all images a user has
     * uploaded.
     */
    public function viewUploads()
    {
        // Gets images using specific user id.
        $images = Images::all()->where('user_id', auth()->user()->id);
        $domains = Domains::all()->where('user_id', auth()->user()->id);

        // Returns view with images
        return view('uploads', compact('images', 'domains'));
    }


    /**
     * View Image Via Slug (shortcode)
     * 
     * This will allow you to access the imgage
     * using a slug/shortcode instead of the path.
     */
    public function viewImageViaSlug($slug)
    {
        $image = Images::where('slug', $slug)->first();

        return response()->file($image->pathname);
    }


    /**
     * Delete image
     * 
     * This will delete the specifide image
     */
    public function deleteImage($id)
    {
        $image = Images::find($id);

        if($image) {
            Storage::delete($image->pathname);
        }

        $image->delete();
        return redirect('/uploads');
    }
}
