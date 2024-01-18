<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Store;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function showCategory($category)
    {
        // Ambil data toko berdasarkan kategori
        $stores = Store::where('category', $category)->get();

        // Kirim data ke view
        return view('component.categoryUmkm', compact('stores', 'category'));
    }
}
