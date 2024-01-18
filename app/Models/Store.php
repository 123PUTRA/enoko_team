<?php

namespace App\Models;

use App\Models\User;
use App\Models\Barang;
use App\Models\Address;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'description',
        'npwp',
        'image_path',
    ];
    protected $table = 'stores';

    public function address()
    {
        return $this->hasOne(Address::class, 'store_id');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
