<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodMenuController extends Controller
{
    public function index()
    {
        $food = Food::where('status', 'show')->orderBy('id', 'desc')->limit(10)->get();

        return view('frontends.foodMenu.index', compact('food'));
    }
}
