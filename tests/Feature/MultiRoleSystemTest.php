<?php

namespace Tests\Feature;

use App\Models\MitraProfile;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiRoleSystemTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $mitraUser;
    private User $konsumenUser;
    private MitraProfile $mitra;
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'nama'     => 'Super Admin',
            'email'    => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);

        $this->mitra = MitraProfile::create([
            'nama_usaha'        => 'Resto Padang Uji',
            'alamat'            => 'Jl. Sudirman No. 1, Pekanbaru',
            'status_verifikasi' => 'verified',
        ]);

        $this->mitraUser = User::create([
            'nama'             => 'Manager Mitra',
            'email'            => 'mitra@test.com',
            'password'         => bcrypt('password123'),
            'role'             => 'mitra_manager',
            'mitra_profile_id' => $this->mitra->id,
        ]);

        $this->konsumenUser = User::create([
            'nama'      => 'Pelanggan Uji',
            'email'     => 'pelanggan@test.com',
            'password'  => bcrypt('password123'),
            'role'      => 'konsumen',
            'google_id' => 'google_test_123',
        ]);

        $this->product = Product::create([
            'mitra_profile_id'     => $this->mitra->id,
            'nama_produk'          => 'Nasi Rendang Komplit',
            'kategori'             => 'nasi',
            'stok'                 => 5,
            'harga_asli'           => 40000,
            'harga_diskon'         => 15000,
            'titik_penjemputan'    => 'Kasir Lt. 1',
            'batas_waktu_konsumsi' => Carbon::now()->addHours(3),
            'status'               => 'tersedia',
        ]);
    }

    public function test_guest_can_access_home_and_katalog(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/katalog')->assertStatus(200);
    }

    public function test_konsumen_cannot_access_admin_or_mitra_dashboard(): void
    {
        $this->actingAs($this->konsumenUser)->get('/admin')->assertStatus(403);
        $this->actingAs($this->konsumenUser)->get('/mitra-dashboard')->assertStatus(403);
    }

    public function test_mitra_can_access_mitra_dashboard_and_reports_but_not_admin(): void
    {
        $this->actingAs($this->mitraUser)->get('/mitra-dashboard')->assertStatus(200);
        $this->actingAs($this->mitraUser)->get('/mitra-dashboard/products')->assertStatus(200);
        $this->actingAs($this->mitraUser)->get('/mitra-dashboard/reports')->assertStatus(200);
        $this->actingAs($this->mitraUser)->get('/admin')->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard_and_mitra_management(): void
    {
        $this->actingAs($this->admin)->get('/admin')->assertStatus(200);
        $this->actingAs($this->admin)->get('/admin/mitra')->assertStatus(200);
        $this->actingAs($this->admin)->get('/admin/users')->assertStatus(200);
    }

    public function test_pelanggan_can_order_food_and_stock_is_reduced(): void
    {
        $initialStock = $this->product->stok;

        $response = $this->actingAs($this->konsumenUser)->post('/pesanan', [
            'product_id' => $this->product->id,
            'jumlah'     => 2,
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('transactions', [
            'user_id'            => $this->konsumenUser->id,
            'product_id'         => $this->product->id,
            'jumlah'             => 2,
            'status_bayar'       => 'paid',
            'status_pengambilan' => 'belum_diambil',
        ]);

        $this->assertEquals($initialStock - 2, $this->product->fresh()->stok);
    }
}
