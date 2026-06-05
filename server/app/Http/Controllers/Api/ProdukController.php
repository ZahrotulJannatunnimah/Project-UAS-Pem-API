<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    // GET /api/produk
    public function index()
    {
        $produk = DB::table('produk')
            ->join('kategori', 'produk.id_kategori', '=', 'kategori.id')
            ->select('produk.*', 'kategori.nama_kategori')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $produk
        ]);
    }

    // GET /api/produk/{id}
    public function show($id)
    {
        $produk = DB::table('produk')
            ->join('kategori', 'produk.id_kategori', '=', 'kategori.id')
            ->select('produk.*', 'kategori.nama_kategori')
            ->where('produk.id', $id)
            ->first();

        if (!$produk) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $produk
        ]);
    }

    // POST /api/produk
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori'  => 'required|integer',
            'nama_produk'  => 'required|string|max:150',
            'harga'        => 'required|integer',
            'stok'         => 'required|integer',
        ]);

        $id = DB::table('produk')->insertGetId([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'created_at'  => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data'    => DB::table('produk')->find($id)
        ], 201);
    }

    // PUT /api/produk/{id}
    public function update(Request $request, $id)
    {
        $produk = DB::table('produk')->find($id);

        if (!$produk) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        DB::table('produk')->where('id', $id)->update([
            'id_kategori' => $request->id_kategori ?? $produk->id_kategori,
            'nama_produk' => $request->nama_produk ?? $produk->nama_produk,
            'harga'       => $request->harga       ?? $produk->harga,
            'stok'        => $request->stok        ?? $produk->stok,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Produk berhasil diupdate',
            'data'    => DB::table('produk')->find($id)
        ]);
    }

    // DELETE /api/produk/{id}
    public function destroy($id)
    {
        $produk = DB::table('produk')->find($id);

        if (!$produk) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        DB::table('produk')->where('id', $id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}