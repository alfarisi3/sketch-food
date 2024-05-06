<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $tables = Table::when($search, function ($tables) use ($search) {
            $tables->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $tables->appends(['search' => $search]);

        return view('backends.table.index', compact('tables', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|min:1|max:50',
                'total_meja' => 'required|numeric',

            ],
            [
                'title.required' => 'Title tidak boleh kosong!',
                'description.required' => 'Description tidak boleh kosong!',
                'total_meja.required' => 'Total meja tidak boleh kosong!',
                'total_meja.numeric' => 'Total meja harus angka!',
            ]
        );

        Table::create([
            'title' => $request->title,
            'description' => $request->description,
            'total_meja' => $request->total_meja
        ]);

        if ($request) {
            return redirect()->route('table.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('table.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        return view('backends.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required|min:1|max:50',
                'total_meja' => 'required|numeric',
            ],
            [
                'title.required' => 'Title tidak boleh kosong!',
                'description.required' => 'Description tidak boleh kosong!',
                'total_meja.required' => 'Total meja tidak boleh kosong!',
                'total_meja.numeric' => 'Total meja harus angka!',
            ]
        );

        Table::where('id', $table->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'total_meja' => $request->total_meja
        ]);

        if ($request) {
            return redirect()->route('table.index')->with('success', 'Data berhasil diupdate!');
        } else {
            return redirect()->route('table,edit', $table->id)->with('error', 'Data gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        Table::destroy('id', $table->id);
        return redirect()->route('table.index')->with('success', 'Data berhasil dihapus!');
    }
}
