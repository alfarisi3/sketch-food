<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Drink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DrinkMenuController extends Controller
{
    public function index()
    {
        $drinks = Drink::where('status', 'show')->orderBy('id', 'desc')->limit(10)->get();

        return view('frontends.drinkMenu.index', compact('drinks'));
    }
}
