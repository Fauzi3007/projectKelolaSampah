<?php

namespace App\Http\Controllers;

use App\Models\PenggunaSarana;
use App\Models\Provinsi;
use App\Models\Sarana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaranaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinsis = Provinsi::all();
        // $jenis_sarana = Sarana::select('jenis_sarana')->distinct()->get();
        $saranas = Sarana::paginate(5);
        return view('pages.sarana.index', compact('saranas', 'provinsis'));
    }

    /**
     * Filter the listing of resources.
     */
    public function filter(Request $request)
    {
        $provinsis = Provinsi::all();
        // $jenis_sarana = Sarana::select('jenis_sarana')->distinct()->get();

        $lokasi = $request->input('selectedProvinsi');
        // $jenis = $request->input('selectedJenisSarana');


        $sarana = Sarana::query();

        $filters = [
            'provinsi_id_provinsi' => $lokasi,
            // 'jenis_sarana' => $jenis,
        ];

        foreach ($filters as $column => $value) {
            if ($value) {
                $sarana->whereIn($column, $value);
            }
        }

        $saranas = $sarana->paginate(5);

        return view('pages.sarana.index', compact('saranas', 'provinsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        $users = User::where('id', Auth::user()->id)->get();
        return view('pages.sarana.create', compact('provinsis','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sarana' => ['required', 'max:50'],
            'alamat_sarana' => ['required', 'max:100'],
            'jenis_sarana' => [ 'max:50'],
            'provinsi_id_provinsi' => ['required',],
            'nama_admin' => ['required'],
            'no_hp' => 'required|numeric'
        ]);

        Sarana::create($validatedData);

        return redirect()->route('sarana.index')->with('success', 'Sarana created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sarana $sarana)
    {

        return view('pages.sarana.show', compact('sarana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sarana $sarana)
    {
        $provinsis = Provinsi::all();
        $users = User::where('id', '=', $sarana->nama_admin)->get();
        return view('pages.sarana.edit', compact('sarana', 'users', 'provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sarana $sarana)
    {
        $validatedData = $request->validate([
            'nama_sarana' => ['required', 'max:50'],
            'alamat_sarana' => ['required', 'max:100'],
            'jenis_sarana' => ['max:50'],
            'provinsi_id_provinsi' => ['required',],
            'nama_admin' => ['required'],
            'no_hp' => 'required|numeric'


        ]);

        $sarana->update($validatedData);

        return redirect()->route('sarana.index')->with('success', 'Sarana updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sarana $sarana)
    {
        $sarana->delete();

        return redirect()->route('sarana.index')->with('success', 'Sarana deleted successfully.');
    }
}
