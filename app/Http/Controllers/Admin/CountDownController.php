<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountDown;

class CountDownController extends Controller
{
    public function index()
    {
        $CountDown = CountDown::all();

        return response()->json([
            'code' => 200,
            'data' => $CountDown[0],
        ], 200);
    }

    public function create(Request $request)
    {
        $create = CountDown::create([

            'title' => $request->title,
            'date'  => $request->date,
            'desc'  => $request->desc,
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
            $upload = CountDown::where('id', $id)->update([

                'title' => $request->title,
                'date'  => $request->date,
                'desc'  => $request->desc,
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
