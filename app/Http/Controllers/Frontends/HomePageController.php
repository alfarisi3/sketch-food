<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Food;
use App\Models\Hero;
use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
       $heroes = Hero::where('status', 'show')->orderBy('id', 'desc')->limit(1)->get();

       $food = Food::where('status', 'show')->orderBy('id', 'desc')->limit(5)->get();

       $quotes = Quote::where('status', 'show')->orderBy('id', 'desc')->limit(2)->get();

       return view('frontends.home.userHome', compact('heroes', 'food', 'quotes'));
    }
}
