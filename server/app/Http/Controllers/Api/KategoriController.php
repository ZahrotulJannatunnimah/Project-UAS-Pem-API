<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // GET /api/kategori
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => DB::table('kategori')->get()
        ]);
    }

    // GET /api/kategori/{id}
    public function show($id)
    {
        $kategori = DB::table('kategori')->find($id);

        if (!$kategori) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $produk = DB::table('produk')->where('id_kategori', $id)->get();

        return response()->json([
            'status' => 'success',
            'data'   => array_merge((array) $kategori, ['produk' => $produk])
        ]);
    }

    // POST /api/kategori
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi'     => 'nullable|string',
        ]);

        $id = DB::table('kategori')->insertGetId([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
            'created_at'    => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil ditambahkan',
            'data'    => DB::table('kategori')->find($id)
        ], 201);
    }

    // PUT /api/kategori/{id}
    public function update(Request $request, $id)
    {
        $kategori = DB::table('kategori')->find($id);

        if (!$kategori) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        DB::table('kategori')->where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori ?? $kategori->nama_kategori,
            'deskripsi'     => $request->deskripsi     ?? $kategori->deskripsi,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil diupdate',
            'data'    => DB::table('kategori')->find($id)
        ]);
    }

    // DELETE /api/kategori/{id}
    public function destroy($id)
    {
        $kategori = DB::table('kategori')->find($id);

        if (!$kategori) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        DB::table('kategori')->where('id', $id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}