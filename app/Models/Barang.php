<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'deskripsi', 'harga', 'quantity','category', 'gambar_path'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}