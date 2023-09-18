<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use File;

class UploadFileController extends Controller
{
    public function UploadFile(Request $request)
    {
        $folder = "";
        $file = $request->file('file');
        $google_id = $request->google_id;

        $mp3 = $request->mp3;

        if(isset($mp3) || !empty($mp3)){
            $validator = Validator::make($request->all(), $this->rulesMp3(), $this->messages(),$this->attributesMp3());
        } else {

            $validator = Validator::make($request->all(), $this->rules(), $this->messages(),$this->attributes());
        }

        if ($validator->fails()) {

            $errors = array();


            return response()->json([
                'code' => 400,
                'errors' => $validator->messages()
            ], 400);
        }

        $fileName = $file->getClientOriginalName();


        $fileData = File::get($file);

       $result = Storage::cloud()->put($fileName, $fileData);


       if($result){
            $fileInfo = Storage::cloud()->getMetadata($fileName);



            $fileId = Helper::GoogleUrlImage($fileInfo['path']);

            if(isset($google_id) || !empty($google_id)){
                $deletFile =  $this->DeleteFile($google_id);
            }


            return response()->json([
                'code'  => 200,
                'data'  => $fileId,
                'google_id' => $google_id
            ],200);
       } else {
            return response()->json([
                'code' => 400,
                'errors' => [
                    'message'   => "Tải file thất bại"
                ]
            ], 400);
       }
    }

    public function DeleteFileGoogle(Request $request){
            $googleId = $request->google_id;
            if($googleId != ""){

            $delete =    $this->DeleteFile($googleId);
                return response()->json([
                    'code' => 200,
                    'data' => $delete,
                    'message' => "Xóa file thành công"
                ]);

            } else {
                return response()->json([
                    'code' => 400,
                    'errors' => [
                        'message'   => "file cần xóa không tồn tại"
                    ]
                    ], 400);
            }
    }


    public function DeleteFile($googleId){
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

            return response()->json([
                'code' => 200,
                'data' => $deleteGoogle,
                'message' => "Xóa file thành công"
            ], 200);
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
            'file.mimes'  => 'File vừa tải không đúng định dạng',
        ];
    }

    public function attributes(){
        return [
            'file'  => "Ảnh",
        ];
    }

    public function rulesMp3(){
        return [
            'file'  => 'required|mimes:mp3',
        ];
    }

    public function attributesMp3(){
        return [
            'file'  => "Mp3",
        ];
    }
}
