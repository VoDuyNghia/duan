<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'username'              => 'required',
            'email'                 => 'required|unique:users,email,'.$request->id.',id',
            'password'              => 'regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"'
        ];
    }
    public function messages() {
        return [
            'email.required'        => 'Vui lòng nhập email',
            'email.unique'          => 'Email đã tồn tại',
            'username.required'     => 'Vui lòng nhập họ và tên',
            'password.required'     => 'Vui lòng nhập mật khẩu',
            'password.regex'        => 'Mật khẩu ít nhất 6 ký tự và có 1 chữ cái viết hoa và viết thường',
        ];
    }
}
