<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $abouts = About::when($search, function ($abouts) use ($search) {
            $abouts->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $abouts->appends(['search' => $search]);

        return view('backends.about.index', compact('abouts', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.about.create');
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
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Picture harus berupa gambar!',
                'picture.max' => 'Picture maksimal 5 MB!',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('img/about'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        About::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $filename,
            'status' => $status
        ]);

        if ($request) {
            return redirect()->route('about.index')->with('success', 'About baru telah ditambahkan!');
        } else {
            return redirect()->route('about.create')->with('failed', 'About gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('backends.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'description.required' => 'Deskripsi wajib diisi!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('img/about/' . $about->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/about'), $filename);

            About::where('id', $about->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'picture' => $filename,
                'status' => $status
            ]);
        } else {
            About::where('id', $about->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $status
            ]);
        }

        if ($request) {
            return redirect()->route('about.index')->with('success', '<strong>Success!</strong> About telah diedit!');
        } else {
            return redirect()->route('about.edit', $about->id)->with('failed', '<strong>Failed!</strong> About gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        if (file_exists(public_path('img/about/' . $about->picture))) {
            unlink(public_path('img/about/' . $about->picture));
        }
        about::destroy('id', $about->id);
        return redirect()->route('about.index')->with('success', 'Data berhasil dihapus!');
    }
}
