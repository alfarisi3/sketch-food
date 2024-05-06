<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Imagem;
use Illuminate\Http\Request;

class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $imagems = Imagem::when($search, function ($imagems) use ($search) {
            $imagems->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $imagems->appends(['search' => $search]);

        return view('backends.imagem.index', compact('imagems', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.imagem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'picture' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
                'type' => 'required',
            ],
            [
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Picture harus berupa gambar!',
                'picture.max' => 'Picture maksimal 5 MB!',
                'type.required' => 'Type wajib dipilih!',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('img/imagem'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Imagem::create([
            'picture' => $filename,
            'type' => $request->type,
            'status' => $status
        ]);

        if ($request) {
            return redirect()->route('imagem.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('imagem.create')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Imagem $imagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imagem $imagem)
    {
        return view('backends.imagem.edit', compact('imagem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imagem $imagem)
    {
        $request->validate(
            [
                'type' => 'required',
            ],
            [
                'type.required' => 'Type wajib dipilih!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->hasFile('picture')) {
            $oldPicture = public_path('img/imagem/' . $imagem->picture);
            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }
            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/imagem'), $filename);

            Imagem::where('id', $imagem->id)->update([
                'picture' => $filename,
                'type' => $request->type,
                'status' => $status
            ]);
        } else {
            Imagem::where('id', $imagem->id)->update([
                'type' => $request->type,
                'status' => $status
            ]);
        }
        if ($request) {
            return redirect()->route('imagem.index')->with('success', 'Data berhasil diupdate!');
        } else {
            return redirect()->route('imagem.edit')->with('error', 'Data gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imagem $imagem)
    {
        if (file_exists(public_path('img/imagem/' . $imagem->picture))) {
            unlink(public_path('img/imagem/' . $imagem->picture));
    }
    imagem::destroy('id', $imagem->id);
    return redirect()->route('imagem.index')->with('success', 'Data berhasil dihapus!');
    }
}
