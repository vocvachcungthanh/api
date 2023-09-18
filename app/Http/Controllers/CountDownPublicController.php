<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountDown;

class CountDownPublicController extends Controller
{
    public function index(){
        $countDown = CountDown::select('title', 'date', 'desc')->get();

        return response()->json([
            'code' => 200,
            'data' => $countDown

        ], 200);
    }
}
