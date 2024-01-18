<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Store;


class HomeController extends Controller
{
    public function index()
{
    // Check if the user is authenticated
    if (Auth::check()) {
        // Check if the user has a store
        if (Auth::user()->store) {
            // Get barangs associated with the store
            $storeBarangs = Auth::user()->store->barangs;

            // Get additional random barangs from other stores
            $otherBarangs = Barang::inRandomOrder()->where('store_id', '!=', Auth::user()->store->id)->limit(8 - $storeBarangs->count())->get();

            // Merge barangs from the store and other barangs
            $barangs = $storeBarangs->merge($otherBarangs);
        } else {
            // User belum membuka toko, dapatkan daftar barang dari semua toko
            $barangs = Barang::inRandomOrder()->get();
        }
    } else {
        // User belum login, dapatkan daftar barang dari semua toko
        $barangs = Barang::inRandomOrder()->get();
    }

    return view('index', ['barangs' => $barangs]);
    }
}