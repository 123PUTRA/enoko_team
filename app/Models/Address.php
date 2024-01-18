<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'provinsi_code',
        'kabupaten_code',
        'kecamatan_code',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi_code', 'code');
    }

    public function kabupaten()
    {
        return $this->belongsTo(City::class, 'kabupaten_code', 'code');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'kecamatan_code', 'code');
    }

    public static function saveAddress($store_id, $provinsi_code, $kabupaten_code, $kecamatan_code)
    {
        try {
            $address = static::create([
                'store_id' => $store_id,
                'provinsi_code' => $provinsi_code,
                'kabupaten_code' => $kabupaten_code,
                'kecamatan_code' => $kecamatan_code,
            ]);

            return $address;
        } catch (\Exception $e) {
            \Log::error('Error in saveAddress: ' . $e->getMessage());
            throw $e;
        }
    }
}
