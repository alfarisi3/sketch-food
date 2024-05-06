<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $banks = Bank::when($search, function ($banks) use ($search) {
            $banks->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $banks->appends(['search' => $search]);

        return view('backends.bank.index', compact('banks', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'bank_name' => 'required',
                'bank_account_number' => 'required',
                'account_name' => 'required',
                'picture' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
            ],
            [
                'bank_name.required' => 'Bank Name wajib diisi!',
                'bank_account_number.required' => 'Bank Account Number wajib diisi!',
                'account_name.required' => 'Account Name wajib diisi!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Picture harus berupa gambar!',

            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('img/bank'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Bank::create([
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'account_name' => $request->account_name,
            'picture' => $filename,
            'status' => $status,
        ]);

        if ($request) {
            return redirect()->route('bank.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('backends.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $request->validate(
            [
                'bank_name' => 'required',
                'bank_account_number' => 'required',
                'account_name' => 'required',
            ],
            [
                'bank_name.required' => 'Bank Name wajib diisi!',
                'bank_account_number.required' => 'Bank Account Number wajib diisi!',
                'account_name.required' => 'Account Name wajib diisi!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('img/bank/' . $bank->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/bank'), $filename);

            Bank::where('id', $bank->id)->update([
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->bank_account_number,
                'account_name' => $request->account_name,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {
            bank::where('id', $bank->id)->update([
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->bank_account_number,
                'account_name' => $request->account_name,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('bank.index')->with('success', 'Data berhasil diedit!');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        if (file_exists(public_path('img/bank/' . $bank->picture))) {
            unlink(public_path('img/bank/' . $bank->picture));
        }
        bank::destroy('id', $bank->id);
        return redirect()->route('bank.index')->with('success', 'Data berhasil dihapus!');
    }
}
