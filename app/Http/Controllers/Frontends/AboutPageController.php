<?php

namespace App\Http\Controllers\Frontends;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutPageController extends Controller
{
    public function index()
    {
        $abouts = About::where('status', 'show')->orderBy('id', 'desc')->limit(1)->get();

        return view('frontends.aboutPage.index', compact('abouts'));
    }
}
