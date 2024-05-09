<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\PerhitunganSampah;
use App\Models\Sarana;
use Illuminate\Http\Request;

class PerhitunganSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perhitunganSampah = PerhitunganSampah::all();
        return view('pages.perhitungan_sampah.index', compact('perhitunganSampah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $saranas = Sarana::all(); 
        return view('pages.perhitungan_sampah.create', compact('kategoris', 'saranas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_sampah' => 'required|integer',
            'sarana_id_sarana' => 'required|integer',
            'kategori_id_kategori' => 'required|integer',
        ]);

        PerhitunganSampah::create($validated);
        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil ditambahkan')  ;
    }

    /**
     * Display the specified resource.
     */
    public function show(PerhitunganSampah $perhitunganSampah)
    {
        return view('pages.perhitungan_sampah.show', compact('perhitunganSampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerhitunganSampah $perhitunganSampah)
    {
        $kategoris = Kategori::all();
        $saranas = Sarana::all(); 
        return view('pages.perhitungan_sampah.edit', compact('perhitunganSampah', 'kategoris', 'saranas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerhitunganSampah $perhitunganSampah)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_sampah' => 'required|integer',
            'sarana_id_sarana' => 'required|integer',
            'kategori_id_kategori' => 'required|integer',
        ]);

        $perhitunganSampah->update($validated);
        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil diubah')  ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerhitunganSampah $perhitunganSampah)
    {
        $perhitunganSampah->delete();
        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil dihapus')  ;
    }
}