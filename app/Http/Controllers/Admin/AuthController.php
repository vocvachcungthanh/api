<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TokenUser;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $auth = User::where('id', $id)->get();

        if(count($auth)){
            return response()->json([
                'code' => 200,
                'data' => $auth['0'],
            ],200);
        } else {
            return response()->json([
                'code'   => 401,
                'errors' => [
                    'message' => "Tai khoản không tồn tại",
                ]
            ], 401);
        }


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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $headers = apache_request_headers();
        $token= $headers['access_token'];

        $checkTokenIsValid = TokenUser::where('token', $token)->first();

        if(!empty($checkTokenIsValid)){
            $result = $checkTokenIsValid->delete();

            return response()->json([
                'code' => 200,
                'data' => $result,
                'message'   => "Đăng xuất thành công"
            ], 200);
        } else {
            return response()->json([
                'code' => 401,
                'message' => "Không thể đăng xuất",
                'status' => false,
            ], 401);
        }
    }

}