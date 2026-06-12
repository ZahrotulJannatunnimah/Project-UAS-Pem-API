<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Beritahu Laravel bahwa nama tabelnya adalah 'produk'
    protected $table = 'produk';
    
    public $timestamps = false;

    // Kolom yang boleh diisi saat input data baru / update
    protected $fillable = ['id_kategori', 'nama_produk', 'harga', 'stok'];
}