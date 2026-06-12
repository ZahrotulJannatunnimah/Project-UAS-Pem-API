<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // LOGIKA MIGRASI DARI register2.php
    public function register(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($username) || empty($email) || empty($password)) {
            return response()->json(["status" => "error", "message" => "Username, email, dan password wajib diisi!"], 400);
        }

        // Cek apakah username atau email sudah terdaftar
        $userExists = DB::table('users')->where('username', $username)->orWhere('email', $email)->exists();
        if ($userExists) {
            return response()->json(["status" => "error", "message" => "Username atau email sudah terdaftar!"], 409);
        }

        // Hash password menggunakan enkripsi standar
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        DB::table('users')->insert([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        return response()->json(["status" => "success", "message" => "Registrasi berhasil!"], 201);
    }

    // LOGIKA MIGRASI DARI login2.php
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (empty($username) || empty($password)) {
            return response()->json(["status" => "error", "message" => "Username dan password wajib diisi!"], 400);
        }

        $user = DB::table('users')->where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {
            // Generate API KEY baru seperti versi native Anda
            $api_key = "ROTI-" . bin2hex(random_bytes(8));
            
            // Simpan API KEY ke user tersebut
            DB::table('users')->where('id', $user->id)->update(['api_key' => $api_key]);

            return response()->json([
                "status" => "success",
                "message" => "Login berhasil!",
                "api_key" => $api_key
            ]);
        } else {
            return response()->json(["status" => "error", "message" => "Username atau password salah!"], 401);
        }
    }
}