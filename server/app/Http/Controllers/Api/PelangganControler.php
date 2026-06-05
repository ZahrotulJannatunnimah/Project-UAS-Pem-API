<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    // GET /api/pelanggan
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => DB::table('pelanggan')->get()
        ]);
    }

    // GET /api/pelanggan/{id}
    public function show($id)
    {
        $pelanggan = DB::table('pelanggan')->find($id);

        if (!$pelanggan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $pelanggan
        ]);
    }

    // POST /api/pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'email'        => 'nullable|email|unique:pelanggan,email',
            'no_telp'      => 'nullable|string|max:20',
            'alamat'       => 'nullable|string',
        ]);

        $id = DB::table('pelanggan')->insertGetId([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
            'alamat'       => $request->alamat,
            'created_at'   => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pelanggan berhasil ditambahkan',
            'data'    => DB::table('pelanggan')->find($id)
        ], 201);
    }

    // PUT /api/pelanggan/{id}
    public function update(Request $request, $id)
    {
        $pelanggan = DB::table('pelanggan')->find($id);

        if (!$pelanggan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        DB::table('pelanggan')->where('id', $id)->update([
            'nama_lengkap' => $request->nama_lengkap ?? $pelanggan->nama_lengkap,
            'email'        => $request->email        ?? $pelanggan->email,
            'no_telp'      => $request->no_telp      ?? $pelanggan->no_telp,
            'alamat'       => $request->alamat        ?? $pelanggan->alamat,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pelanggan berhasil diupdate',
            'data'    => DB::table('pelanggan')->find($id)
        ]);
    }

    // DELETE /api/pelanggan/{id}
    public function destroy($id)
    {
        $pelanggan = DB::table('pelanggan')->find($id);

        if (!$pelanggan) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        DB::table('pelanggan')->where('id', $id)->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pelanggan berhasil dihapus'
        ]);
    }
}