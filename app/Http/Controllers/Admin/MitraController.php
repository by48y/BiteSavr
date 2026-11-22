<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MitraProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MitraController extends Controller
{
    public function index(Request $request)
    {
        $query = MitraProfile::withCount(['users', 'products']);

        if ($request->filled('search')) {
            $query->where('nama_usaha', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        $mitras = $query->latest()->paginate(10)->withQueryString();

        return view('admin.mitra.index', compact('mitras'));
    }

    public function create()
    {
        return view('admin.mitra.create');
    }

    public function store(Request $request)
    {
        $mitraData = $request->validate([
            'nama_usaha'       => ['required', 'string', 'max:150'],
            'alamat'           => ['required', 'string'],
            'koordinat'        => ['nullable', 'string', 'max:100'],
            'no_telepon'       => ['nullable', 'string', 'max:20'],
            'email_usaha'      => ['nullable', 'email', 'max:150'],
            'deskripsi'        => ['nullable', 'string'],
            'kategori'         => ['nullable', 'string', 'max:100'],
            'jam_operasional'  => ['nullable', 'string', 'max:100'],
            'status_verifikasi'=> ['required', 'in:pending,verified,rejected'],
        ]);

        $userData = $request->validate([
            'manager_nama'     => ['required', 'string', 'max:100'],
            'manager_email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'manager_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $mitra = MitraProfile::create($mitraData);

        User::create([
            'mitra_profile_id' => $mitra->id,
            'nama'             => $userData['manager_nama'],
            'email'            => $userData['manager_email'],
            'password'         => Hash::make($userData['manager_password']),
            'role'             => 'mitra_manager',
        ]);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra "' . $mitra->nama_usaha . '" berhasil ditambahkan beserta akun managernya.');
    }

    public function edit(MitraProfile $mitra)
    {
        $mitra->load('users');
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, MitraProfile $mitra)
    {
        $data = $request->validate([
            'nama_usaha'       => ['required', 'string', 'max:150'],
            'alamat'           => ['required', 'string'],
            'koordinat'        => ['nullable', 'string', 'max:100'],
            'no_telepon'       => ['nullable', 'string', 'max:20'],
            'email_usaha'      => ['nullable', 'email', 'max:150'],
            'deskripsi'        => ['nullable', 'string'],
            'kategori'         => ['nullable', 'string', 'max:100'],
            'jam_operasional'  => ['nullable', 'string', 'max:100'],
            'status_verifikasi'=> ['required', 'in:pending,verified,rejected'],
        ]);

        $mitra->update($data);

        return redirect()->route('admin.mitra.index')
            ->with('success', 'Data mitra berhasil diperbarui.');
    }

    public function updateStatus(Request $request, MitraProfile $mitra)
    {
        $request->validate(['status_verifikasi' => 'required|in:pending,verified,rejected']);
        $mitra->update(['status_verifikasi' => $request->status_verifikasi]);

        return back()->with('success', 'Status verifikasi "' . $mitra->nama_usaha . '" berhasil diubah menjadi ' . $mitra->status_label . '.');
    }

    public function destroy(MitraProfile $mitra)
    {
        $mitra->delete();
        return redirect()->route('admin.mitra.index')
            ->with('success', 'Mitra berhasil dihapus.');
    }
}
