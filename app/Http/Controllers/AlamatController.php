<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class AlamatController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function showLocationForm()
    {
        $provinces = $this->locationService->getAllProvinces();
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

            Address::saveAddress($storeId, $provinsi, $kabupaten, $kecamatan);

            return redirect()->route('store.dashboard')->with('success', 'Lokasi berhasil disimpan!');
        } catch (\Exception $e) {
            \Log::error('Error in saveSelectedLocation: ' . $e->getMessage());
            return redirect()->route('store.dashboard')->with('error', 'Terjadi kesalahan saat menyimpan lokasi. ' . $e->getMessage());
        }
    }

    public function getKabupatenByProvinsi(Request $request)
    {
        return $this->locationService->getKabupatenByProvinsi($request);
    }

    public function getKecamatanByKabupaten($kabupatenCode)
    {
        return $this->locationService->getKecamatanByKabupaten($kabupatenCode);
    }
}