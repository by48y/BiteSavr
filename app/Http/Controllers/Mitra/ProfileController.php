<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $mitra = Auth::user()->mitraProfile ?? abort(403);
        return view('mitra.profile.edit', compact('mitra'));
    }

    public function update(Request $request)
    {
        $mitra = Auth::user()->mitraProfile ?? abort(403);

        $data = $request->validate([
            'nama_usaha'      => ['required', 'string', 'max:150'],
            'alamat'          => ['required', 'string'],
            'no_telepon'      => ['nullable', 'string', 'max:20'],
            'email_usaha'     => ['nullable', 'email', 'max:150'],
            'deskripsi'       => ['nullable', 'string'],
            'kategori'        => ['nullable', 'string', 'max:100'],
            'jam_operasional' => ['nullable', 'string', 'max:100'],
            'koordinat'       => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('foto_usaha')) {
            $data['foto_usaha'] = $request->file('foto_usaha')->store('mitra', 'public');
        }

        $mitra->update($data);

        return redirect()->route('mitra.profile.edit')
            ->with('success', 'Profil usaha berhasil diperbarui.');
    }
}
