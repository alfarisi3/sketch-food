<?php

namespace App\Http\Controllers\Backends;

use App\Models\Dessert;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DessertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $desserts = Dessert::when($search, function ($desserts) use ($search) {
            $desserts->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $desserts->appends(['search' => $search]);

        return view('backends.dessert.index', compact('desserts', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.dessert.create');
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
        $picture->move(public_path('img/dessert'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        $slug = Str::slug($request->title);

        $checkSlug = Dessert::where('slug', $slug)->first();
        if($checkSlug){
            return redirect()->route('dessert.create')->with('error', ' Data dessert sudah ada!');
        }


        Dessert::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'picture' => $filename,
            'status' => $status

        ]);

        if ($request) {
            return redirect()->route('dessert.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('dessert.create')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dessert $dessert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dessert $dessert)
    {
        return view('backends.dessert.edit', compact('dessert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dessert $dessert)
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
            $oldPicture = public_path('img/dessert/' . $dessert->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/dessert'), $filename);

            $slug = Str::slug($request->title);

            $checkSlug = Dessert::where('slug', $slug)->first();
            if($checkSlug){
                return redirect()->route('dessert.edit')->with('error', ' Data dessert sudah ada!');
            }

            Dessert::where('id', $dessert->id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'price' => $request->price,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {

            $slug = $dessert->slug;

            $checkSlug = Dessert::where('slug', $slug)->first();
            if($checkSlug){
                return redirect()->route('dessert.edit')->with('error', ' Data dessert sudah ada!');
            }

            if ($request->has('title')) {
                $slug = Str::slug($request->title);
            }
            dessert::where('id', $dessert->id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('dessert.index')->with('success', 'Data berhasil diedit!');
        } else {
            return redirect()->route('dessert.edit')->with('error', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dessert $dessert)
    {
        if (file_exists(public_path('img/dessert/' . $dessert->picture))) {
            unlink(public_path('img/dessert/' . $dessert->picture));
        }
        dessert::destroy('id', $dessert->id);
        return redirect()->route('dessert.index')->with('success', 'Data berhasil dihapus!');
    }
}
