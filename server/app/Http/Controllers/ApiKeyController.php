<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function generate(Request $request)
    {
        $user = auth()->user();
        $user->api_key = 'trapi-' . Str::random(32);
        $user->save();

        return redirect()->route('home')->with('success', 'API Key berhasil digenerate!');
    }

    public function delete(Request $request)
    {
        $user = auth()->user();
        $user->api_key = null;
        $user->save();

        return redirect()->route('home')->with('success', 'API Key berhasil dihapus!');
    }
}