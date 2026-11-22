<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function getMitra()
    {
        return Auth::user()->mitraProfile ?? abort(403);
    }

    public function index(Request $request)
    {
        $mitra = $this->getMitra();
        $query = $mitra->products();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('mitra.products.index', compact('products', 'mitra'));
    }

    public function create()
    {
        return view('mitra.products.create');
    }

    public function store(Request $request)
    {
        $mitra = $this->getMitra();

        $data = $request->validate([
            'nama_produk'          => ['required', 'string', 'max:150'],
            'kategori'             => ['required', 'in:nasi,roti_kue,seafood,minuman,mie,lainnya'],
            'stok'                 => ['required', 'integer', 'min:1'],
            'harga_asli'           => ['required', 'numeric', 'min:0'],
            'harga_diskon'         => ['required', 'numeric', 'min:0', 'lt:harga_asli'],
            'titik_penjemputan'    => ['required', 'string', 'max:255'],
            'deskripsi'            => ['nullable', 'string'],
            'batas_waktu_konsumsi' => ['required', 'date', 'after:now'],
            'status'               => ['required', 'in:tersedia,habis,kadaluarsa,nonaktif'],
        ]);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $mitra->products()->create($data);

        return redirect()->route('mitra.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $this->authorizeProduct($product);
        return view('mitra.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $data = $request->validate([
            'nama_produk'          => ['required', 'string', 'max:150'],
            'kategori'             => ['required', 'in:nasi,roti_kue,seafood,minuman,mie,lainnya'],
            'stok'                 => ['required', 'integer', 'min:0'],
            'harga_asli'           => ['required', 'numeric', 'min:0'],
            'harga_diskon'         => ['required', 'numeric', 'min:0', 'lt:harga_asli'],
            'titik_penjemputan'    => ['required', 'string', 'max:255'],
            'deskripsi'            => ['nullable', 'string'],
            'batas_waktu_konsumsi' => ['required', 'date'],
            'status'               => ['required', 'in:tersedia,habis,kadaluarsa,nonaktif'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('mitra.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);
        $product->delete();

        return redirect()->route('mitra.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function authorizeProduct(Product $product): void
    {
        $mitra = $this->getMitra();
        if ($product->mitra_profile_id !== $mitra->id) {
            abort(403);
        }
    }
}
