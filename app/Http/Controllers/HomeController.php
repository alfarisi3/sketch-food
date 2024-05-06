<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Hero;
use App\Models\Drink;
use App\Models\Quote;
use App\Models\Dessert;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
    //  * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $heroes = Hero::where('status', 'show')->orderBy('id', 'desc')->limit(1)->get();

        $food = Food::where('status', 'show')->orderBy('id', 'desc')->limit(5)->get();

        $quotes = Quote::where('status', 'show')->orderBy('id', 'desc')->limit(2)->get();

        return view('frontends.home.userHome', compact('heroes', 'food', 'quotes'));
    }

    public function adminHome()
    {

        $jumlahReservasi = Reservation::count();

        // buatkan gabungan jumlah data food, drink, dessert
        $jumlahFood = Food::count();
        $jumlahDrink = Drink::count();
        $jumlahDessert = Dessert::count();

        $jumlahMenu = $jumlahFood + $jumlahDrink + $jumlahDessert;

        $belumBayar = Reservation::where('status', 'belum bayar')->count();

        $sudahBayar = Reservation::where('status', 'sudah bayar')->count();



        return view('backends.home.adminHome', compact('jumlahReservasi', 'jumlahMenu', 'belumBayar', 'sudahBayar'));
    }
}
