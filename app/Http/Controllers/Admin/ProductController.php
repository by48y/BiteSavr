<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MitraProfile;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('mitraProfile');

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('mitra')) {
            $query->where('mitra_profile_id', $request->mitra);
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $mitras   = MitraProfile::pluck('nama_usaha', 'id');

        return view('admin.products.index', compact('products', 'mitras'));
    }
}
