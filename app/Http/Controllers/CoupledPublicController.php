<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Couple;
use App\Models\Bgs;

class CoupledPublicController extends Controller
{
   public function index(){
    $couples = Couple::select('avatar', 'desc', 'facebook','id', 'instagram', 'name','status')->get();

        $bgCouple = Bgs::select('bg')->where('key', '=', 'couple')->get();

        return response()->json([
            'code' => 200,
            'data' => [
                'data' => $couples,
                'bgCouple' => $bgCouple[0]
            ]

        ], 200);
    }
}
