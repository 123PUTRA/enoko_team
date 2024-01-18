<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class AddressController extends Controller
{
    public function showLocationForm()
    {
        // Mendapatkan data provinsi
        $provinces = \Laravolt\Indonesia\Models\Province::all();

        return view('locations.locationform', compact('provinces'));
    }

    public function saveSelectedLocation(Request $request)
    {
        $request->validate([
            'provinsi' => 'required|exists:indonesia_provinces,code',
            'kabupaten' => 'required|exists:indonesia_cities,code',
            'kecamatan' => 'required|exists:indonesia_districts,code',
        ]);

        try {
            $storeId = auth()->id();
            $provinsi = $request->input('provinsi');
            $kabupaten = $request->input('kabupaten');
            $kecamatan = $request->input('kecamatan');

            // Simpan alamat
            Address::saveAddress($storeId, $provinsi, $kabupaten, $kecamatan);

            return redirect()->route('store.dashboard')->with('success', 'Lokasi berhasil disimpan!');
        } catch (\Exception $e) {
            \Log::error('Error in saveSelectedLocation: ' . $e->getMessage());
            return redirect()->route('store.dashboard')->with('error', 'Terjadi kesalahan saat menyimpan lokasi. ' . $e->getMessage());
        }
    }


    // AddressController.php
   // AddressController.php
    public function getCitiesByProvince($provinsi)
    {
        $kabupatenData = City::where('province_code', $provinsi)->get();

        return response()->json($kabupatenData);
    }



    // Metode ini mengembalikan data kecamatan berdasarkan kabupaten
     public function getDistrictsByKabupaten($kabupaten)
    {
        $kecamatanData = District::where('city_code', $kabupaten)->get();

        return response()->json($kecamatanData);
    }
}