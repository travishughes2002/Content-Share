<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikeys;

class SettingsController extends Controller
{
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

        return view('settings', compact('apiKeys'));
    }
}
