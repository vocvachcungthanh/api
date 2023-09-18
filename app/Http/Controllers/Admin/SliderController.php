<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
use Storage;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $create = Slider::create([
            'image' => $request->image,
            'url'  => $request->url,
            'desc' => $request->desc,
            'title' => $request->title,
            'status'    => 1,
            'google_id' => $request->google_id,
            'source_id' => $request->source_id,
            'created_at' => now()
        ]);

        if($create) {
            return response()->json([
                'code' => 200,
                'data' =>  $create,
                'message' => "Thêm slider thành công"

            ],200);
        } else{
            return response()->json([
                'code' => 400,
                'errors' => [
                    'message' => "Thêm slider thất bại",
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$page1)
    {
        $page = $request->input('page', $page1);
        $perPage = $request->input('per_page', 20);
        $sliders =   Slider::orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $page);

       return response()->json([
        'code'  => 200,
        'data'  => $sliders,
       ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

       if($id){
            $status = Slider::where('id', $id)->update([
                'status' => $status
            ]);

            if($status = 1) {
                return response()->json([
                    'code' => 200,
                    'data' =>  $status,
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
       }else{
         return response()->json([
            'core'  => 400,
            'errors' => [
                'message' => "slider cần thay đổi trạng thái không tồn tại"
            ]
         ],400);
       }
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
        $title = $request->title;
        $image = $request->image;
        $url   = $request->url;
        $desc = $request->desc;
        $google_id = $request->google_id;
        $source =$request->source_id;

        if($id){
            $upload = Slider::where('id', $id)->update([
                'title' => $title,
                'image' => $image,
                'url'   => $url,
                'desc'  => $desc,
                'google_id' => $google_id,
                'source_id' => $source,
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
                    'message' => "slider bạn cần sửa không tồn tại"
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
    public function delete(Request $request)
    {
        $source = $request->source_id;
        $id = $request->id;

        if($source == 2) {
            $googleId = $request->google_id;
            $dirs = "/";
            $recursive = true;

            $fileinfo = collect(Storage::disk('google')->listContents($dirs,$recursive))->where('type', 'file')->where('path', $googleId)->first();

            if($fileinfo == null) return response()-> json([
                'code' => 400,
                'errors' => [
                    'message'   => "Không tìm thấy file cần xóa"
                ]
            ],400);

            $deleteGoogle = Storage::disk('google')->delete($fileinfo['path']);
        }

        $deleteMsql = Slider::where('id', $id)->delete();

        if($deleteMsql == -1){
            return response()->json([
                'code' => 400,
                'errors' =>[
                    'message' => "Xóa slider thất bại",
                ]
            ], 400);
        } else {
            return response()->json([
                'code' => 200,
                'data' =>  $id,
                'message' =>  'Xóa slider thành công'
            ],200);
        }


    }


    public function collects(){
        $dirs = "/";
        $recursive = true;
        $contets = collect(Storage::disk('google')->listContents($dirs,$recursive));

        return $contets;
    }

    public function rules()
    {
        return [
            'file'  => 'required|mimes:jpeg,png,jpg,gif,webp',
        ];
    }

    public function messages(){
        return [
            'file.required'  => 'File vừa tải không đúng định dạng',
            'file.mimes'  => 'Tệp vừa tải không phải là ảnh',
        ];
    }

    public function attributes(){
        return [
            'file'  => "Ảnh",
        ];
    }
}