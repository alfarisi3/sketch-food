<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $quotes = Quote::when($search, function ($quotes) use ($search) {
            $quotes->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $quotes->appends(['search' => $search]);

        return view('backends.quote.index', compact('quotes', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.quote.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'picture' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
                'pembagi' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Picture harus berupa gambar!',
                'picture.max' => 'Picture maksimal 5 MB!',
                'pembagi.required' => 'Pembagi wajib dipilih!',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('img/quote'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Quote::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $filename,
            'pembagi' => $request->pembagi,
            'status' => $status
        ]);

        if ($request) {
            return redirect()->route('quote.index')->with('success', '<strong>Success!</strong> Quote baru telah ditambahkan!');
        } else {
            return redirect()->route('quote.create')->with('failed', '<strong>Failed!</strong> Quote gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        return view('backends.quote.edit', compact('quote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'pembagi' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'pembagi.required' => 'Pembagi wajib dipilih!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('img/quote/' . $quote->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/quote'), $filename);

            Quote::where('id', $quote->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'picture' => $filename,
                'pembagi' => $request->pembagi,
                'status' => $status
            ]);
        } else {
            Quote::where('id', $quote->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'pembagi' => $request->pembagi,
                'status' => $status
            ]);
        }

        if ($request) {
            return redirect()->route('quote.index')->with('success', '<strong>Success!</strong> Quote telah diedit!');
        } else {
            return redirect()->route('quote.edit', $quote->id)->with('failed', '<strong>Failed!</strong> Quote gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        if (file_exists(public_path('img/quote/' . $quote->picture))) {
            unlink(public_path('img/quote/' . $quote->picture));
        }
        quote::destroy('id', $quote->id);
        return redirect()->route('quote.index')->with('success', 'Data berhasil dihapus!');
    }
}
