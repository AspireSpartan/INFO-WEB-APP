<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicOfficial;

class PublicOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officials = PublicOfficial::all();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('officials'));
    }

}
