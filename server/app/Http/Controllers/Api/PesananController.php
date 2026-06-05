<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // GET /api/pesanan
    public function index()
    {
        $pesanan = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id')
            ->select('pesanan.*', 'pelanggan.nama_lengkap')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $pesanan
        ]);
    }

    // GET /api/pesanan/{id}
    public function show($id)
    {
        $pesanan = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id')
            ->select('pesanan.*', 'pelanggan.nama_lengkap')
            ->where('pesanan.id', $id)
            ->first();

        if (!$pesanan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        $detail = DB::table('detail_pesanan')
            ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id')
            ->select('detail_pesanan.*', 'produk.nama_produk')
            ->where('detail_pesanan.id_pesanan', $id)
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => array_merge((array) $pesanan, ['detail' => $detail])
        ]);
    }

    // POST /api/pesanan
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan'      => 'required|integer',
            'total_harga'       => 'required|integer',
            'status_pembayaran' => 'nullable|in:Pending,Lunas,Batal',
        ]);

        $id = DB::table('pesanan')->insertGetId([
            'id_pelanggan'      => $request->id_pelanggan,
            'tanggal_pesanan'   => now(),
            'total_harga'       => $request->total_harga,
            'status_pembayaran' => $request->status_pembayaran ?? 'Pending',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pesanan berhasil dibuat',
            'data'    => DB::table('pesanan')->find($id)
        ], 201);
    }

    // PUT /api/pesanan/{id}
    public function update(Request $request, $id)
    {
        $pesanan = DB::table('pesanan')->find($id);

        if (!$pesanan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        DB::table('pesanan')->where('id', $id)->update([
            'id_pelanggan'      => $request->id_pelanggan      ?? $pesanan->id_pelanggan,
            'total_harga'       => $request->total_harga       ?? $pesanan->total_harga,
            'status_pembayaran' => $request->status_pembayaran ?? $pesanan->status_pembayaran,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pesanan berhasil diupdate',
            'data'    => DB::table('pesanan')->find($id)
        ]);
    }

    // DELETE /api/pesanan/{id}
    public function destroy($id)
    {
        $pesanan = DB::table('pesanan')->find($id);

        if (!$pesanan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        DB::table('detail_pesanan')->where('id_pesanan', $id)->delete();
        DB::table('pesanan')->where('id', $id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pesanan berhasil dihapus'
        ]);
    }
}