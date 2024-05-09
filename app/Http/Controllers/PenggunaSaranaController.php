<?php

namespace App\Http\Controllers;

use App\Models\PenggunaSarana;
use Illuminate\Http\Request;

class PenggunaSaranaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna_saranas = PenggunaSarana::all();
        return view('pages.pengguna_sarana.index', compact('pengguna_saranas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengguna_sarana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_admin' => ['required', 'max:50'],
            'no_hp' => ['required', 'max:20'],
            'role' => ['required', 'max:20'],
        ]);

        PenggunaSarana::create($validatedData);

        return redirect()->route('pengguna_sarana.index')->with('success', 'Pengguna Sarana created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenggunaSarana $pengguna_sarana)
    {
        return view('pages.pengguna_sarana.show', compact('pengguna_sarana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenggunaSarana $pengguna_sarana)
    {
        return view('pages.pengguna_sarana.edit', compact('pengguna_sarana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenggunaSarana $pengguna_sarana)
    {
        $validatedData = $request->validate([
            'nama_admin' => ['required', 'max:50'],
            'no_hp' => ['required', 'max:20'],
            'role' => ['required', 'max:20'],
        ]);

        $pengguna_sarana->update($validatedData);

        return redirect()->route('mitra.index')->with('success', 'Pengguna Sarana updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenggunaSarana $pengguna_sarana)
    {
        $pengguna_sarana->delete();

        return redirect()->route('mitra.index')->with('success', 'Pengguna Sarana deleted successfully.');
    }
}
