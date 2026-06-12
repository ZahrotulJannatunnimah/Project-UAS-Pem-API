<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Beritahu Laravel bahwa nama tabelnya adalah 'kategori'
    protected $table = 'kategori';
    
    // Set ke false karena tabel Anda hanya punya created_at, tidak ada updated_at
    public $timestamps = false; 

    // Kolom yang boleh diisi secara massal
    protected $fillable = ['nama_kategori', 'deskripsi'];
}