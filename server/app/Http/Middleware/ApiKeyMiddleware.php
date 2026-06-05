<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->bearerToken();

        if (!$apiKey) {
            return response()->json([
                'status'  => 'error',
                'message' => 'API Key tidak ditemukan. Sertakan Authorization: Bearer {api_key}'
            ], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'API Key tidak valid atau tidak terdaftar'
            ], 401);
        }

        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}