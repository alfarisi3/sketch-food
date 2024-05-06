<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Food;
use App\Models\Drink;
use App\Models\Imagem;
use App\Models\Dessert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuPageController extends Controller
{
    public function index()
    {
        $imagems = Imagem::where('status', 'show')->orderBy('id', 'desc')->limit(3)->get();

        $food = Food::where('status', 'show')->orderBy('id', 'desc')->limit(5)->get();

        $drinks = Drink::where('status', 'show')->orderBy('id', 'desc')->limit(5)->get();

        $desserts = Dessert::where('status', 'show')->orderBy('id', 'desc')->limit(5)->get();

        return view('frontends.menuPage.index', compact( 'imagems','food', 'drinks', 'desserts'));

    }

    // public function foodDetail($slug)
    // {
    //     $food = Food::where('slug', $slug)->first();

    //     return view('frontends.menuPage.foodDetail', compact('food'));
    // }

}
