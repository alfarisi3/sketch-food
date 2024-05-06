<?php

namespace App\Http\Controllers\Backends;

use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $reservations = Reservation::with('user', 'table')
        ->when($search, function ($reservations) use ($search) {
            $reservations->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $reservations->appends(['search' => $search]);

        return view('backends.reservation.index', compact('reservations', 'search', 'pagination'));
    }

    public function status(Reservation $reservation)
    {
        if ($reservation->status == 'belum bayar') {
            Reservation::where('id', $reservation->id)->update(['status' => 'sudah bayar']);

            return redirect()->back()->with('success', 'Status reservasi An. <srtong style="color: blue;">' . Auth::user()->name . '<strong>Berhasil di update</strong>');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::with('reservation')->get();

        $users = User::with('reservation')->get();

        return view('backends.reservation.create', compact('tables', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
                'table_id.required' => 'Table wajib diisi!',
                'name.required' => 'Name wajib diisi!',
                'phone.required' => 'Phone wajib diisi!',
                'email.required' => 'Email wajib diisi!',
                'time.required' => 'Time wajib diisi!',
                'date.required' => 'Date wajib diisi!',
            ]
        );

        //tanggal
        $request->merge(['date' => date('Y-m-d', strtotime($request->date))]);

        //jam
        $request->merge(['time' => date('H:i', strtotime($request->time))]);

        // $table = Table::where('id', $request->table_id)->first();

        // tampilkan table berelasi dengan reservasi

        // $table = Reservation::where('table_id', $request->table_id)->first();

        // if ($table->status == 0) {

        //     return redirect()->route('reservation.create')->with('error', 'Table not available!');
        // }

        Reservation::create([
            'user_id' => Auth::user()->id,
            'table_id' => $request->table_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'time' => $request->time,
            'date' => $request->date,

        ]);

        if ($request) {

            return redirect()->route('reservation.index')->with('success', 'Reservation created successfully!');
        } else {
            return redirect()->route('reservation.create')->with('error', 'Reservation created failed!');
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        Reservation::destroy($reservation->id);
        return redirect()->route('reservation.index')->with('success', 'Data berhasil dihapus!');
    }
}
