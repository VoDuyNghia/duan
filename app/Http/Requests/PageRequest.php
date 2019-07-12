<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PageRequest extends FormRequest
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

            'name'              => 'required',
            'name_vn'           => 'required',
            'description'       => 'required',
            'description_vn'    => 'required',
        ];
    }
    public function messages() {
        return [
            'name.required'               => 'Vui lòng nhập tiêu đề tin (EN)',
            'name_vn.required'            => 'Vui lòng nhập tiêu đề tin (VN)',
            'description.required'        => 'Vui lòng nhập nội dung tin (EN)',
            'description_vn.required'     => 'Vui lòng nhập nội dung tin (VN)',
        ];
    }
}
