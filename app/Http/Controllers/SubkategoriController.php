<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Subkategori;
use Illuminate\Http\Request;

class SubkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subkategoris = Subkategori::paginate(5);
        return view('pages.subkategori.index', compact('subkategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('pages.subkategori.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_subkategori' => 'required|string',
            'kategori_id_kategori' => 'required'
        ]);

        Subkategori::create($request->all());

        return redirect()->route('subkategori.index')
            ->with('success', 'Subkategori created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subkategori $subkategori)
    {
        return view('pages.subkategori.show', compact('subkategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subkategori $subkategori)
    {
        $kategoris = Kategori::all();
        return view('pages.subkategori.edit', compact('subkategori', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subkategori $subkategori)
    {
        $request->validate([
            'nama_subkategori' => 'required|string',
            'kategori_id_kategori' => 'required'
        ]);

        $subkategori->update($request->all());

        return redirect()->route('subkategori.index')
            ->with('success', 'Subkategori updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subkategori $subkategori)
    {

        $subkategori->delete();

        return redirect()->route('subkategori.index')
            ->with('success', 'Subkategori deleted successfully');

        //
    }
}
