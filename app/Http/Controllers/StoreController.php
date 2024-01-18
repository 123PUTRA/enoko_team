<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function dashboard()
    {
        // Memastikan bahwa pengguna sudah login
        if (auth()->check()) {
            // Mendapatkan data toko berdasarkan pengguna yang sedang login
            $store = Store::where('user_id', auth()->id())->first();

            if ($store) {
                // Ambil data alamat dari tabel addresses
                $addressData = Address::where('store_id', $store->id)->first();

                return view('store.dashboard', compact('store', 'addressData'));
            }
        }
        return redirect('/')->with('error', 'Anda belum membuka toko. Silakan buka toko terlebih dahulu.');
    }


    public function detail($storeId)
    {
        $store = Store::findOrFail($storeId);

        $barangs = $store->barangs;

        $addressData = Address::where('store_id', $store->id)->first();
        return view('store.detail', compact('store', 'barangs', 'addressData'));
    }

   // Menampilkan form untuk membuka toko
    public function openStoreForm()
    {
        return view('store.open_store_form');
    }

    public function openStore(Request $request)
    {
        // Validasi input untuk membuka toko
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'npwp' => 'required|string|digits:15|unique:stores',
            'store_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Membuat toko baru
        $store = Store::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'npwp' => $request->npwp,
        ]);

        // Handle unggah gambar
        if ($request->hasFile('store_image')) {
            $image = $request->file('store_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'uploadsfptoko';

            // Simpan gambar ke dalam direktori public
            $image->move(public_path($imagePath), $imageName);

            // Simpan path gambar ke dalam database
            $store->update(['image_path' => $imagePath . '/' . $imageName]);
        }

        return redirect()->route('store.dashboard')->with('success', 'Toko berhasil dibuka!');
    }


    // Menampilkan form untuk membuat alamat
    public function createAddress(Request $request)
    {
        // Validasi input untuk membuat alamat
        $request->validate([
        'store_id' => 'required|exists:stores,id',
        'provinsi_code' => 'required|string',
        'kabupaten_code' => 'required|string',
        'kecamatan_code' => 'required|string',
    ]);

    // Simpan data alamat
    $address = Address::create([
        'store_id' => $request->store_id,
        'provinsi_code' => $request->provinsi_code,
        'kabupaten_code' => $request->kabupaten_code,
        'kecamatan_code' => $request->kecamatan_code,
    ]);
        return redirect()->route('store.dashboard')->with('success', 'Alamat berhasil disimpan!');
    }

}