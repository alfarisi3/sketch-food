<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $heroes = Hero::when($search, function ($heroes) use ($search) {
            $heroes->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $heroes->appends(['search' => $search]);

        return view('backends.hero.index', compact('heroes', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.hero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'title_2nd' => 'required',
                'description' => 'required',
                'description_2nd' => 'required',
                'picture' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
                'picture_2nd' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
                'picture_3rd' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title_2nd.required' => 'Title 2nd wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'description_2nd.required' => 'Deskripsi 2nd wajib diisi!',
                'picture.required' => 'Picture wajib diisi!',
                'picture_2nd.required' => 'Picture 2nd wajib diisi!',
                'picture_3rd.required' => 'Picture 3rd wajib diisi!',
                'picture.image' => 'Picture harus berupa gambar!',
                'picture_2nd.image' => 'Picture 2nd harus berupa gambar!',
                'picture_3rd.image' => 'Picture 3rd harus berupa gambar!',
                'picture.mimes' => 'Picture harus berupa jpg,jpeg,png,svg!',
                'picture_2nd.mimes' => 'Picture 2nd harus berupa jpg,jpeg,png,svg!',
                'picture_3rd.mimes' => 'Picture 3rd harus berupa jpg,jpeg,png,svg!',
                'picture.max' => 'Picture maksimal 5 MB!',
                'picture_2nd.max' => 'Picture maksimal 5 MB!',
                'picture_3rd.max' => 'Picture maksimal 5 MB!',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('img/hero'), $filename);

        $picture_2nd = $request->file('picture_2nd');
        $filename2 = time() . '-' . rand() . '-' . $picture_2nd->getClientOriginalName();
        $picture_2nd->move(public_path('img/hero'), $filename2);

        $picture_3rd = $request->file('picture_3rd');
        $filename3 = time() . '-' . rand() . '-' . $picture_3rd->getClientOriginalName();
        $picture_3rd->move(public_path('img/hero'), $filename3);

        $status = $request->has('status') ? 'show' : 'hide';

        hero::create([
            'title' => $request->title,
            'title_2nd' => $request->title_2nd,
            'description' => $request->description,
            'description_2nd' => $request->description_2nd,

            'picture' => $filename,
            'picture_2nd' => $filename2,
            'picture_3rd' => $filename3,

            'status' => $status
        ]);

        if ($request) {
            return redirect()->route('hero.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('hero.create')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        return view('backends.hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        $request->validate(
            [
                'title' => 'required',
                'title_2nd' => 'required',
                'description' => 'required',
                'description_2nd' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title_2nd.required' => 'Title 2nd wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'description_2nd.required' => 'Deskripsi 2nd wajib diisi!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';


        // untuk banyak foto
        $pictures = ['picture', 'picture_2nd', 'picture_3rd'];
        $filenames = [];

        foreach ($pictures as $pictureField) {
            if ($request->has($pictureField)) {
                $oldPicture = public_path('img/hero/' . $hero->$pictureField);
                if (file_exists($oldPicture)) {
                    unlink($oldPicture);
                }
                $picture = $request->file($pictureField);
                $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
                $picture->move(public_path('img/hero'), $filename);

                $filenames[$pictureField] = $filename;
            }
        }


        $updateData = [
            'title' => $request->title,
            'title_2nd' => $request->title_2nd,
            'description' => $request->description,
            'description_2nd' => $request->description_2nd,
            'status' => $status
        ] + $filenames;

        hero::where('id', $hero->id)->update($updateData);
        // untuk banyak foto
        

        if ($request) {
            return redirect()->route('hero.index')->with('success', 'Data berhasil diedit!');
        } else {
            return redirect()->route('hero.edit')->with('error', 'Data gagal diedit!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        if (file_exists(public_path('img/hero/' . $hero->picture))) {
            unlink(public_path('img/hero/' . $hero->picture));
        }
        hero::destroy('id', $hero->id);
        return redirect()->route('hero.index')->with('success', 'Data berhasil dihapus!');
    }
}
