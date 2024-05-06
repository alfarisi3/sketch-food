<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backends\BankController;
use App\Http\Controllers\Backends\FoodController;
use App\Http\Controllers\Backends\HeroController;
use App\Http\Controllers\Backends\AboutController;
use App\Http\Controllers\Backends\DrinkController;
use App\Http\Controllers\Backends\QuoteController;
use App\Http\Controllers\Backends\TableController;
use App\Http\Controllers\Backends\ImagemController;
use App\Http\Controllers\Backends\DessertController;
use App\Http\Controllers\Frontends\PaymentController;
use App\Http\Controllers\Frontends\FoodMenuController;
use App\Http\Controllers\Frontends\HomePageController;
use App\Http\Controllers\Frontends\MenuPageController;
use App\Http\Controllers\Frontends\AboutPageController;
use App\Http\Controllers\Frontends\DrinkMenuController;
use App\Http\Controllers\Backends\ReservationController;
use App\Http\Controllers\Frontends\DessertMenuController;
use App\Http\Controllers\Frontends\InputReservController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.appFrontend');
});

Auth::routes();

//Home Page Routes
Route::get('/', [HomePageController::class, 'index'])->name('home.page');

//MEMU
Route::get('/menu', [MenuPageController::class, 'index'])->name('menu.index');
//Food Routes
Route::get('menu/foodMenu', [FoodMenuController::class, 'index'])->name('foodMenu.index');
//Drinks Routes
Route::get('menu/drinkMenu', [DrinkMenuController::class, 'index'])->name('drinkMenu.index');
//Dessert Routes
Route::get('menu/dessertMenu', [DessertMenuController::class, 'index'])->name('dessertMenu.index');
//MENU

//ABOUT
Route::get('/aboutPage', [AboutPageController::class, 'index'])->name('aboutPage.index');
//ABOUT


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Route
Route::middleware(['auth', 'CheckRole:user'])->group(function () {
    //userHome
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    //reservation
    Route::get('/reservasi', [InputReservController::class, 'status'])->name('inputReservation.status');
    Route::delete('/reservasi/destroy/{reservation}', [InputReservController::class, 'destroy'])->name('inputReservation.destroy');
    //input reservation
    Route::get('/reservasi/input', [InputReservController::class, 'input'])->name('inputReservation.input');
    Route::post('/reservasi/store', [InputReservController::class, 'store'])->name('inputReservation.store');

    //Payment
    Route::get('/reservasi/payment', [PaymentController::class, 'index'])->name('payment.index');
});

// Admin Route
Route::middleware(['auth', 'CheckRole:admin'])->group(function () {

    //adminHome
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    //hero routes
    Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/admin/hero/create', [HeroController::class, 'create'])->name('hero.create');
    route::post('/admin/hero/store', [HeroController::class, 'store'])->name('hero.store');
    Route::get('/admin/hero/edit/{hero}', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/admin/hero/update/{hero}', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/admin/hero/destroy/{hero}', [HeroController::class, 'destroy'])->name('hero.destroy');

    //img menu
    Route::get('/admin/imagemenu', [ImagemController::class, 'index'])->name('imagem.index');
    Route::get('/admin/imagemenu/create', [ImagemController::class, 'create'])->name('imagem.create');
    route::post('/admin/imagemenu/store', [ImagemController::class, 'store'])->name('imagem.store');
    Route::get('/admin/imagemenu/edit/{imagem}', [ImagemController::class, 'edit'])->name('imagem.edit');
    Route::put('/admin/imagemenu/update/{imagem}', [ImagemController::class, 'update'])->name('imagem.update');
    Route::delete('/admin/imagemenu/destroy/{imagem}', [ImagemController::class, 'destroy'])->name('imagem.destroy');


    //food routes
    Route::get('/admin/food', [FoodController::class, 'index'])->name('food.index');
    Route::get('/admin/food/create', [FoodController::class, 'create'])->name('food.create');
    route::post('/admin/food/store', [FoodController::class, 'store'])->name('food.store');
    Route::get('/admin/food/edit/{food}', [FoodController::class, 'edit'])->name('food.edit');
    Route::put('/admin/food/update/{food}', [FoodController::class, 'update'])->name('food.update');
    Route::delete('/admin/food/destroy/{food}', [FoodController::class, 'destroy'])->name('food.destroy');


    //drink routes
    Route::get('/admin/drink', [DrinkController::class, 'index'])->name('drink.index');
    Route::get('/admin/drink/create', [DrinkController::class, 'create'])->name('drink.create');
    route::post('/admin/drink/store', [DrinkController::class, 'store'])->name('drink.store');
    Route::get('/admin/drink/edit/{drink}', [DrinkController::class, 'edit'])->name('drink.edit');
    Route::put('/admin/drink/update/{drink}', [DrinkController::class, 'update'])->name('drink.update');
    Route::delete('/admin/drink/destroy/{drink}', [DrinkController::class, 'destroy'])->name('drink.destroy');

    //dessert routes
    Route::get('/admin/dessert', [DessertController::class, 'index'])->name('dessert.index');
    Route::get('/admin/dessert/create', [DessertController::class, 'create'])->name('dessert.create');
    route::post('/admin/dessert/store', [DessertController::class, 'store'])->name('dessert.store');
    Route::get('/admin/dessert/edit/{dessert}', [DessertController::class, 'edit'])->name('dessert.edit');
    Route::put('/admin/dessert/update/{dessert}', [DessertController::class, 'update'])->name('dessert.update');
    Route::delete('/admin/dessert/destroy/{dessert}', [DessertController::class, 'destroy'])->name('dessert.destroy');

    //quote
    Route::get('/admin/quote', [QuoteController::class, 'index'])->name('quote.index');
    Route::get('/admin/quote/create', [QuoteController::class, 'create'])->name('quote.create');
    route::post('/admin/quote/store', [QuoteController::class, 'store'])->name('quote.store');
    Route::get('/admin/quote/edit/{quote}', [QuoteController::class, 'edit'])->name('quote.edit');
    Route::put('/admin/quote/update/{quote}', [QuoteController::class, 'update'])->name('quote.update');
    Route::delete('/admin/quote/destroy/{quote}', [QuoteController::class, 'destroy'])->name('quote.destroy');

    //about
    Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/admin/about/create', [AboutController::class, 'create'])->name('about.create');
    route::post('/admin/about/store', [AboutController::class, 'store'])->name('about.store');
    Route::get('/admin/about/edit/{about}', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/admin/about/update/{about}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('/admin/about/destroy/{about}', [AboutController::class, 'destroy'])->name('about.destroy');

    //Table
    Route::get('/admin/table', [TableController::class, 'index'])->name('table.index');
    Route::get('/admin/table/create', [TableController::class, 'create'])->name('table.create');
    route::post('/admin/table/store', [TableController::class, 'store'])->name('table.store');
    Route::get('/admin/table/edit/{table}', [TableController::class, 'edit'])->name('table.edit');
    Route::put('/admin/table/update/{table}', [TableController::class, 'update'])->name('table.update');
    Route::delete('/admin/table/destroy/{table}', [TableController::class, 'destroy'])->name('table.destroy');

    //Bank
    Route::get('/admin/bank', [BankController::class, 'index'])->name('bank.index');
    Route::get('/admin/bank/create', [BankController::class, 'create'])->name('bank.create');
    route::post('/admin/bank/store', [BankController::class, 'store'])->name('bank.store');
    Route::get('/admin/bank/edit/{bank}', [BankController::class, 'edit'])->name('bank.edit');
    Route::put('/admin/bank/update/{bank}', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/admin/bank/destroy/{bank}', [BankController::class, 'destroy'])->name('bank.destroy');

    //Reservation
    Route::get('/admin/reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/admin/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
    route::post('/admin/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    Route::delete('/admin/reservation/destroy/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');


    //status reservation
    Route::get('/admin/reservation/status/{reservation}', [ReservationController::class, 'status'])->name('reservation.status');
});
