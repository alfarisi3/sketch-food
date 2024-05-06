<?php

namespace App\Http\Controllers\Backends;

use App\Models\Drink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $drinks = Drink::when($search, function ($drinks) use ($search) {
            $drinks->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $drinks->appends(['search' => $search]);

        return view('backends.drink.index', compact('drinks', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.drink.create');
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
                'price' => 'required',
                'picture' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'price.required' => 'Harga wajib diisi!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Picture harus berupa gambar!',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('img/drink'), $filename);

        $slug = Str::slug($request->title);

        $checkslug = Drink::where('slug', $slug)->first();
        if ($checkslug) {
            return redirect()->route('drink.create')->with('error', 'Data drink sudah ada!');
        }

        $status = $request->has('status') ? 'show' : 'hide';

        Drink::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'picture' => $filename,
            'status' => $status,
        ]);

        if ($request) {
            return redirect()->route('drink.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('drink.create')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Drink $drink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drink $drink)
    {
        return view('backends.drink.edit', compact('drink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Drink $drink)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'price.required' => 'Harga wajib diisi!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('img/drink/' . $drink->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/drink'), $filename);
            $slug = Str::slug($request->title);

            $checkslug = Drink::where('slug', $slug)->first();
            if ($checkslug) {
                return redirect()->route('drink.edit', $drink->id)->with('error', 'Data drink sudah ada!');
            }



            Drink::where('id', $drink->id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'price' => $request->price,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {

            $slug = $drink->slug;

            $checkslug = Drink::where('slug', $slug)->first();
            if ($checkslug) {
                return redirect()->route('drink.edit', $drink->id)->with('error', 'Data drink sudah ada!');
            }

            if ($request->has('title')) {
                $slug = Str::slug($request->title);
            }

            drink::where('id', $drink->id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('drink.index')->with('success', 'Data berhasil diedit!');
        } else {
            return redirect()->route('drink.edit')->with('error', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drink $drink)
    {
        if(file_exists(public_path('img/drink/' . $drink->picture)))
        {
            unlink(public_path('img/drink/' . $drink->picture));
        }
        drink::destroy('id', $drink->id);
        return redirect()->route('drink.index')->with('success', 'Data berhasil dihapus!');
    }
}
