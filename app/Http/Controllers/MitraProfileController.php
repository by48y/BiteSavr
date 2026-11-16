<?php

namespace App\Http\Controllers;

use App\Models\MitraProfile;
use Illuminate\Http\Request;

class MitraProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mitra.index', [
            'mitras' => MitraProfile::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MitraProfile::create($this->validated($request));

        return redirect()->route('mitra.index')->with('success', 'Mitra berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MitraProfile $mitraProfile)
    {
        return redirect()->route('mitra.edit', $mitraProfile);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MitraProfile $mitraProfile)
    {
        return view('mitra.edit', compact('mitraProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MitraProfile $mitraProfile)
    {
        $mitraProfile->update($this->validated($request));

        return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MitraProfile $mitraProfile)
    {
        $mitraProfile->delete();

        return redirect()->route('mitra.index')->with('success', 'Mitra berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_usaha' => ['required', 'string', 'max:150'],
            'alamat' => ['required', 'string'],
            'koordinat' => ['nullable', 'string', 'max:100'],
            'status_verifikasi' => ['required', 'in:pending,verified,rejected'],
        ]);
    }
}
