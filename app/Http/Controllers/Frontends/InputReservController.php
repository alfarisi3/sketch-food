<?php

namespace App\Http\Controllers\Frontends;

use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InputReservController extends Controller
{
    public function status()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();

        return view('frontends.inputReservation.status', compact('reservations'));
    }

    public function input()
    {
        $tables = Table::with('reservation')->get();

        $users = User::with('reservation')->get();

        return view('frontends.inputReservation.input', compact('tables', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'table_id' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'time' => 'required',
                'date' => 'required',
            ],
            [
                'table_id.required' => 'meja harus diisi',
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'phone.required' => 'Nomor Telepon harus diisi',
                'time.required' => 'Waktu harus diisi',
                'date.required' => 'Tanggal harus diisi',
            ]
        );

        //tanggal
        $request->merge(['date' => date('Y-m-d', strtotime($request->date))]);

        //jam
        $request->merge(['time' => date('H:i', strtotime($request->time))]);




        Reservation::create([
            'user_id' => Auth::user()->id,
            'table_id' => $request->table_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        if ($request) {
            return redirect()->route('payment.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('inputReservation.input')->with('error', 'Data gagal ditambahkan!');
        }
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        if ($reservation) {
            return redirect()->route('inputReservation.status')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->route('inputReservation.status')->with('error', 'Data gagal dihapus!');
        }
    }
}
