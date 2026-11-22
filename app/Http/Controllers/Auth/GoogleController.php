<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        $clientId = config('services.google.client_id');

        // Jika GOOGLE_CLIENT_ID belum diisi dengan kredensial asli Google Cloud Console
        if (empty($clientId) || $clientId === 'your-google-client-id') {
            $user = User::firstOrCreate(
                ['email' => 'pelanggan@bitesavr.id'],
                [
                    'nama'     => 'Budi Santoso (Pelanggan)',
                    'role'     => 'konsumen',
                    'password' => bcrypt('password123'),
                ]
            );

            Auth::login($user, true);

            return redirect('/')->with('success', 'Berhasil masuk sebagai Pelanggan.');
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Google gagal: ' . $e->getMessage());
        }

        // Cari berdasarkan google_id terlebih dahulu, atau berdasarkan email
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user) {
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'nama'      => $user->nama ?: $googleUser->getName(),
            ]);
        } else {
            $user = User::create([
                'nama'      => $googleUser->getName() ?: 'Pelanggan Google',
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'role'      => 'konsumen',
                'password'  => bcrypt(str()->random(32)),
            ]);
        }

        Auth::login($user, true);

        return redirect('/');
    }
}
