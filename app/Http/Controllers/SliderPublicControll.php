<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Slider;
class SliderPublicControll extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::select('id', 'image','url','title','desc')->where('status', '=', 1)->orderBy('id', 'desc')->get();


        return response()->json([
            'code' => 200,
            'data'  =>  $sliders
        ], 200);
    }
}