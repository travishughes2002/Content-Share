<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomDomains;

/**
 * Custom Domains
 * 
 * Handles the custom domains function.
 */
class CustomDomainsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index
     */
    public function index()
    {
        $customDomains = CustomDomains::all()->where('user_id', auth()->user()->id);

        return response()->json(['domains' => $customDomains, 'status' => '200'], 200);
    }


    /**
     * Store
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'domain' => ['required']
        ]);
        
        // This creates the database entery.
        $domain = CustomDomains::create([
            'domain' => $request->domain,
            'user_id' => auth()->user()->id
        ]);
        
        return response()->json(['message' => 'successful', 'domain' => $domain, 'status' => '200'], 200);
    }

    /**
     * Delete
     */
    public function delete($id)
    {
        $domain = CustomDomains::find($id);

        $domain->delete();

        return response()->json(['message' => 'successful', 'status' => '200'], 200);
    }
}
