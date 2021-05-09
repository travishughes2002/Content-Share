<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiKey;
use App\Models\CustomDomains;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload()
    {
        return view('pages.upload');
    }

    public function viewSettings()
    {
        $apiKeys = ApiKey::all()->where('user_id', auth()->user()->id);
        $customDomains = CustomDomains::all()->where('user_id', auth()->user()->id);
        return view('pages.settings', compact('apiKeys', 'customDomains'));
    }
}
