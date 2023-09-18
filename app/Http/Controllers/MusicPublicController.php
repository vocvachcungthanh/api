<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;

class MusicPublicController extends Controller
{
    public function index()
    {
        $music = Music::select('id', 'link','name', 'thumbnail', 'singer')->get();

        return response()->json([
            'code' => 200,
            'data' => $music,
        ], 200);
    }
}
