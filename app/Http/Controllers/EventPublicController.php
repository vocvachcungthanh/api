<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventPublicController extends Controller
{
    public function index(){
        $events = Event::select('image', 'address', 'time_date','id', 'title', 'key', 'map')->get();

        return response()->json([
            'code' => 200,
            'data' => $events

        ], 200);
    }
}
