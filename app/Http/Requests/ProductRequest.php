<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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

            'choose_id'         => 'required',
            'name'              => 'required|unique:product,name,'.$request->id.',id',
            'code'              => 'required|unique:product,code,'.$request->id.',id',
            'name_vn'           => 'required',
            'detail'            => 'required',
            'detail_vn'         => 'required',
            'description'       => 'required',
            'description_vn'    => 'required',
            'collection_id'     => 'required',
            'district_id'       => 'required',
            'address'           => 'required',
            'price'             => 'required',
            'active'            => 'required',
        ];
    }
    public function messages() {
        return [
            'name.required'               => 'Vui lòng nhập mã sản phẩm',
            'name.unique'                 => 'Mã sản phẩm đã tồn tại',
            'choose_id.required'          => 'Vui lòng chọn thể loại.',
            'collection_id.required'      => 'Vui lòng chọn danh mục.',
            'name.required'               => 'Vui lòng nhập tiêu đề tin (EN)',
            'name.unique'                 => 'Tiêu đề tin (EN) đã tồn tại',
            'name_vn.required'            => 'Vui lòng nhập tiêu đề tin (VN)',
            'detail.required'             => 'Vui lòng nhập chi tiết tin (EN)',
            'detail_vn.required'          => 'Vui lòng nhập chi tiết tin (VN)',
            'description.required'        => 'Vui lòng nhập nội dung tin (EN)',
            'description_vn.required'     => 'Vui lòng nhập nội dung tin (VN)',
            'district_id.required'        => 'Vui lòng chọn quận.',
            'address.required'            => 'Vui lòng nhập địa chỉ.',
            'price.required'              => 'Vui lòng nhập giá.',
            'active.required'             => 'Vui lòng chọn tình trạng bài viết.',
        ];
    }
}
