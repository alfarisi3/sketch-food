<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Dessert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DessertMenuController extends Controller
{
    public function index()
    {
        $dessert = Dessert::where('status', 'show')->orderBy('id', 'desc')->limit(10)->get();

        return view('frontends.dessertMenu.index', compact('dessert'));
    }

}
