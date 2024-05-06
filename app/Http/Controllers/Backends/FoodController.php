<?php

namespace App\Http\Controllers\Backends;

use App\Models\Food;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 10;

        $foods = Food::when($search, function ($foods) use ($search) {
            $foods->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $foods->appends(['search' => $search]);

        return view('backends.food.index', compact('foods', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.food.create');
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
                'picture' => 'required|mimes:jpg,jpeg,png,svg|max:5120',
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
        $picture->move(public_path('img/food'), $filename);

        $slug = Str::slug($request->title);

        $checkSlug = Food::where('slug', $slug)->first();
        if($checkSlug){
            return redirect()->route('food.create')->with('error', ' Data food sudah ada!');
        }

        $status = $request->has('status') ? 'show' : 'hide';

        Food::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'picture' => $filename,
            'status' => $status
        ]);

        if ($request) {
            return redirect()->route('food.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('food.create')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('backends.food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
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
            $oldPicture = public_path('img/food/' . $food->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('img/food'), $filename);
            $slug = Str::slug($request->title);

            $checkSlug = Food::where('slug', $slug)->first();
            if($checkSlug){
                return redirect()->route('food.create')->with('error', ' Data food sudah ada!');
            }



            Food::where('id', $food->id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'price' => $request->price,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {

            $slug = $food->slug;

            $checkSlug = Food::where('slug', $slug)->first();
            if($checkSlug){
                return redirect()->route('food.create')->with('error', ' Data food sudah ada!');
            }

            if ($request->has('title')) {
                $slug = Str::slug($request->title);
            }

            food::where('id', $food->id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('food.index')->with('success', 'Data berhasil diedit!');
        } else {
            return redirect()->route('food.edit')->with('error', 'Data gagal diedit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        if(file_exists(public_path('img/food/' . $food->picture)))
        {
            unlink(public_path('img/food/' . $food->picture));
        }
        food::destroy('id', $food->id);
        return redirect()->route('food.index')->with('success', 'Data berhasil dihapus!');
    }
}
