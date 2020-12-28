<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Uploads;

/**
 * UploadsController
 * 
 * This controllers all the handling of the upload functions of the application like 
 * uploading, deleting, indexing etc.
 */
class UploadsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Index
     * 
     * This gets all the uploads with the assosiated user and returns then in a view.
     */
    public function index()
    {
        // Gets images using specific user id.
        $uploads = Uploads::all()->where('user_id', auth()->user()->id);

        // Returns view with images
        return view('pages.uploads', compact('uploads'));
    }


    /**
     * Store
     * 
     * This stores the inputed content and adds a entery into the database.
     */
    public function store(Request $request)
    {
        // dd($request->file('file')->extension());
        
        // This checks the inputed data to make sure its vaid. It checks if theres been
        // anything inputed then makes sure its an image.
        $validatedData = $request->validate([
            'file' => ['required', 'mimes:jpeg,png,gif,jpg,mp3,mp4,avi,ogg,wmv']
        ]);
        
        // This stores the image. It takes the $request (inputed data) and stores it in
        // the image disk under the user id.
        $filePath = $request->file->store('public/files/' . auth()->user()->id);
        
        // This creates the database entery.
        Uploads::create([
            'path_name' => str_replace('public/', $filePath),
            'slug' => Str::random(10),
            'user_id' => auth()->user()->id
        ]);
        
        return redirect()->back();
    }


    /**
     * View
     * 
     * Using the slug this will return an upload
     */
    public function view($slug)
    {
        $file = Uploads::where('slug', $slug)->first();

        // return Storage::get(storage_path('app/public/') . $file->path_name);
        return Storage::get(realpath(storage_path('app/public')) . '/' . $file->path_name);
    }


    /**
     * Delete
     * 
     * This deletes the submitted image.
     */
    public function delete($id)
    {
        $upload = Uploads::find($id);

        if($upload) {
            Storage::delete($upload->path_name);
        }

        $upload->delete();
        return redirect('/uploads');
    }
}
