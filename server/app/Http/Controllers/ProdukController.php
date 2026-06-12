<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Memanggil Model Produk dari Langkah 3

class ProdukController extends Controller
{
    // 1. GET (Membaca seluruh data produk)
    public function index()
    {
        // Pengganti "SELECT * FROM produk"
        $produk = Produk::all(); 
        return response()->json($produk, 200);
    }

    // 2. POST (Menambah produk baru)
    public function store(Request $request)
    {
        $id_kategori = $request->input('id_kategori');
        $nama_produk = $request->input('nama_produk');
        $harga = $request->input('harga');
        $stok = $request->input('stok');

        if (empty($id_kategori) || empty($nama_produk) || empty($harga) || isset($stok) === false) {
            return response()->json(["status" => "error", "message" => "Semua kolom data produk wajib diisi!"], 400);
        }

        // Simpan data menggunakan Eloquent Model
        $produk = Produk::create([
            'id_kategori' => $id_kategori,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'stok' => $stok
        ]);

        return response()->json(["status" => "success", "message" => "Produk roti baru berhasil ditambahkan!"], 201);
    }

    // 3. PUT (Mengubah data produk berdasarkan ID)
    public function update(Request $request, $id)
    {
        // Cari produk berdasarkan ID yang dikirim melalui URL
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(["status" => "error", "message" => "Data produk tidak ditemukan!"], 404);
        }

        $id_kategori = $request->input('id_kategori');
        $nama_produk = $request->input('nama_produk');
        $harga = $request->input('harga');
        $stok = $request->input('stok');

        if (empty($id_kategori) || empty($nama_produk) || empty($harga) || isset($stok) === false) {
            return response()->json(["status" => "error", "message" => "Semua kolom data harus diisi untuk update!"], 400);
        }

        // Update data ke database
        $produk->update([
            'id_kategori' => $id_kategori,
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'stok' => $stok
        ]);

        return response()->json(["status" => "success", "message" => "Data produk berhasil diperbarui!"], 200);
    }

    // 4. DELETE (Menghapus data produk berdasarkan ID)
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(["status" => "error", "message" => "Gagal menghapus data atau ID tidak ditemukan!"], 404);
        }

        $produk->delete();
        return response()->json(["status" => "success", "message" => "Produk roti berhasil dihapus!"], 200);
    }
}