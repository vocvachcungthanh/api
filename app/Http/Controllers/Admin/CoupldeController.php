<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Couple;
use App\Models\Bgs;

class CoupldeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couples = Couple::all();

        $bgCouple = Bgs::where('key', '=', 'couple')->get();

        return response()->json([
            'code' => 200,
            'data' => [
                'data' => $couples,
                'bgCouple' => $bgCouple[0]
            ]

        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $create = Couple::create([
            'avatar' => $request->avatar,
            'name' => $request->name,
            'facebook'  => $request->facebook,
            'instagram'  => $request->instagram,
            'desc' => $request->desc,
            'google_id' => $request->google_id,
            'source_id' => $request->source_id,
            'status'    => $request->status,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id){
            $upload = Couple::where('id', $id)->update([
                'avatar' => $request->avatar,
                'name' => $request->name,
                'facebook'  => $request->facebook,
                'instagram'  => $request->instagram,
                'desc' => $request->desc,
                'google_id' => $request->google_id,
                'source_id' => $request->source_id,
                'status'    => $request->status,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
