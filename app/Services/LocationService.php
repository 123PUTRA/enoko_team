<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class LocationService
{
    public function getAllProvinces()
    {
        return Province::all(['code', 'name']);
    }

    public function getKabupatenByProvinsi(Request $request)
    {
        try {
            $provinsiCode = $request->input('provinsi');
            $province = Province::with('cities')->where('code', $provinsiCode)->first();

            if ($province) {
                $kabupatenData = $province->cities->map(function ($city) {
                    return [
                        'code' => $city->code,
                        'name' => $city->name,
                    ];
                });

                return response()->json(['kabupaten' => $kabupatenData]);
            }

            return response()->json(['kabupaten' => []]);
        } catch (\Exception $e) {
            Log::error('Error in getKabupatenByProvinsi: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getKecamatanByKabupaten($kabupatenCode)
    {
        try {
            // Logika pengambilan data kecamatan
            $kecamatanData = District::where('city_code', $kabupatenCode)->get(['code', 'name']);
            return $kecamatanData;
        } catch (\Exception $e) {
            Log::error('Error in getKecamatanByKabupaten: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }




}