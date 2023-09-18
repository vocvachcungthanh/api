<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bgs;

class BgsController extends Controller
{
    public function index(){
        $bgs = Bgs::all();

        return response()->json([
            'code' => 200,
            'data' => bgs,
        ], 200);
    }

    public function create(Request $request)
    {
        $create = Bgs::create([
            'bg'        => $request->bg,
            'key'           => $request->key,
            'google_id'     => $request->google_id,
            'source_id'     => $request->source_id,
            'created_at'    => now()
        ]);

        if($create) {
            return response()->json([
                'code' => 200,
                'data' =>  $create,
                'message' => "Thêm background thành công"

            ],200);
        } else {
            return response()->json([
                'code' => 400,
                'errors' => [
                    'message' => "Thêm background thất bại",
                ]

            ], 400);
        }
    }

    public function update(Request $request, $id)
    {

        if($id){
            $upload = Bgs::where('id', $id)->update([
                'bg'            => $request->bg,
                'key'           => $request->key,
                'google_id'     => $request->google_id,
                'source_id'     => $request->source_id,
                'updated_at'    => now()
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
                    'message' => "Background cần sửa không tồn tại"
                ]
             ],400);
        }
    }
}
