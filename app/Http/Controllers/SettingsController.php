<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikeys;
use App\Domains;

class SettingsController extends Controller
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
     * View Settings Page
     * 
     * This returns the settings page with the necessary data required
     * like API Keys, custom domains etc.
     */
    public function viewSettingsPage()
    {
        // Gets API keys related to user my querying via the user ID.
        $apiKeys = Apikeys::all()->where('user_id', auth()->user()->id);
        $domains = Domains::all()->where('user_id', auth()->user()->id);

        return view('settings', compact('apiKeys', 'domains'));
    }
}
