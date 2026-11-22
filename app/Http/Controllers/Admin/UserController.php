<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MitraProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('mitraProfile');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $mitras = MitraProfile::where('status_verifikasi', 'verified')->get();
        return view('admin.users.create', compact('mitras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'             => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'unique:users,email'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
            'role'             => ['required', 'in:admin,mitra_manager,mitra_staff,konsumen'],
            'mitra_profile_id' => ['nullable', 'exists:mitra_profiles,id'],
        ]);

        User::create([
            'nama'             => $data['nama'],
            'email'            => $data['email'],
            'password'         => Hash::make($data['password']),
            'role'             => $data['role'],
            'mitra_profile_id' => $data['mitra_profile_id'] ?? null,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $mitras = MitraProfile::where('status_verifikasi', 'verified')->get();
        return view('admin.users.edit', compact('user', 'mitras'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama'             => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'unique:users,email,' . $user->id],
            'role'             => ['required', 'in:admin,mitra_manager,mitra_staff,konsumen'],
            'mitra_profile_id' => ['nullable', 'exists:mitra_profiles,id'],
            'password'         => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $updateData = [
            'nama'             => $data['nama'],
            'email'            => $data['email'],
            'role'             => $data['role'],
            'mitra_profile_id' => $data['mitra_profile_id'] ?? null,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
