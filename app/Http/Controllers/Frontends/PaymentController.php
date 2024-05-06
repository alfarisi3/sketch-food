<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {

        $banks = Bank::where('status', 'show')->orderBy('id', 'desc')->limit(2)->get();

        return view('frontends.payment.index', compact('banks'));
    }
}
