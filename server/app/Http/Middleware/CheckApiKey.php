<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        // Membaca API KEY dari header request (X-API-KEY atau x-api-key)
        $apiKey = $request->header('X-API-KEY');

        if (empty($apiKey)) {
            return response()->json(["status" => "error", "message" => "API KEY diperlukan!"], 401);
        }

        // Validasi ke tabel users apakah API KEY terdaftar dan valid
        $userExists = DB::table('users')
            ->where('api_key', $apiKey)
            ->whereNotNull('api_key')
            ->exists();

        if (!$userExists) {
            return response()->json(["status" => "error", "message" => "API KEY tidak valid!"], 403);
        }

        // Jika valid, teruskan request ke Controller
        return $next($request);
    }
}