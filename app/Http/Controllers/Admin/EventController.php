<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return response()->json([
            'code' => 200,
            'data' => $events,
        ], 200);
    }

    public function create(Request $request)
    {
        $create = Event::create([
            'image' => $request->image,
            'title' => $request->title,
            'time_date'  => $request->time_date,
            'address'  => $request->address,
            'map' => $request->map,
            'google_id' => $request->google_id,
            'source_id' => $request->source_id,
            'key'    => $request->key,
            'created_at' => now()
        ]);

        if($create) {
            return response()->json([
                'code' => 200,
                'data' =>  $create,
                'message' => "Thêm dữ liệu thành công"

            ],200);
        } else{
            return response()->json([
                'code' => 400,
                'errors' => [
                    'message' => "Thêm dữ liệu thất bại",
                ]

            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if($id){
            $upload = Event::where('id', $id)->update([
                'image' => $request->image,
                'title' => $request->title,
                'time_date'  => $request->time_date,
                'address'  => $request->address,
                'map' => $request->map,
                'google_id' => $request->google_id,
                'source_id' => $request->source_id,
                'key'    => $request->key,
                'updated_at' => now()
            ]);

            if($upload = 1) {
                return response()->json([
                    'code' => 200,
                    'data' =>  $upload,
                    'message' => "Cập nhật thành công"
                ],200);
            } else{
                return response()->json([
                    'code' => 400,
                    'errors' => [
                        'message' => "Cập nhật thất bại",
                    ]
                ], 400);
            }
        } else {
            return response()->json([
                'core'  => 400,
                'errors' => [
                    'message' => "Thông tin cần sửa không tồn tại"
                ]
             ],400);
        }
    }
}
