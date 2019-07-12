<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactRequest extends FormRequest
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
            'email'                 => 'required',
            'phone'                 => 'required',
            'message'               => 'required',
        ];
    }
    public function messages() {
        return [
            'email.required'        => 'Vui lòng nhập email',
            'username.required'     => 'Vui lòng nhập họ và tên',
            'phone.required'        => 'Vui lòng nhập số điện thoại',
            'message.required'      => 'Vui lòng nhập nội dung',
        ];
    }
}
