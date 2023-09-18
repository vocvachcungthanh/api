<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\TokenUser;


class LoginController extends Controller
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
        $validator = Validator::make($request->all(), $this->rules(), $this->messages(),$this->attributes());

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'errors' => $validator->messages()
            ], 400);
        }

        $dataCheckLogin = [
            'username' => $request->username,
            'password' => $request->password,
        ];


        $checkAuth = auth()->attempt($dataCheckLogin);

        if($checkAuth){

            $id = auth()->id();

            $checkTokenExit = TokenUser::where('user_id', $id)->first();

            if(empty($checkTokenExit)){
                $tokenUser = TokenUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expired' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_token_expired' => date('Y-m-d H:i:s', strtotime('+360 day')),
                    'user_id' => $id,
                ]);
            } else {
                $tokenUser = $checkTokenExit;
            }

           return response()->json([
            'code' => 200,
            'data' =>  $tokenUser,
            'status' => [
                'message' => "Đăng nhập thành công",
                'status' => true
            ]
           ], 200);
        } else {
            return response()->json([
                'code' => 401,
                'errors' => [
                    'message' => 'Tài khoản hoặc mật khẩu không đúng'
                ]
            ], 401);
        }


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
        //
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


    public function rules()
    {
        return [
            'username'  => 'required',
            'password'  => 'required'
        ];
    }

    public function messages(){
        return [
            'username.required'  => ':attribute bắt buộc phải nhập',
            'password.required'  => ':attribute bắt buộc phải nhập'
        ];
    }

    public function attributes(){
        return [
            'username'  => "Tên tài khoản",
            'password'  => "Mật khẩu"
        ];
    }
}