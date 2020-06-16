<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domains;

class DomainsController extends Controller
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
     * Add Domain
     * 
     * This on exacution gets the inputed data and stores it in a database.
     */
    public function addDomain(Request $request) 
    {
        
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'domain' => ['required', 'string', Rule::notIn(['https://', 'https://'])]
        ]);

        Domains::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/settings');
    }

    /**
     * Delete Domain
     * 
     * This deletes the specifide domain
     */
    public function deleteDomain($id) 
    {
        $domain = Domains::find($id);

        $domain->delete();

        return redirect('/settings');
    }
}
