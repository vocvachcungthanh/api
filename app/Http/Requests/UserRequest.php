<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
