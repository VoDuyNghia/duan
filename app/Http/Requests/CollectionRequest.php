<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CollectionRequest extends FormRequest
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
            'name_category'        => 'required|unique:collection,name,'.$request->id.',id',
            'position'             => 'required|unique:collection,position,'.$request->id.',id',
        ];
    }
    public function messages() {
        return [
            'name_category.required'    => 'Vui lòng nhập tên danh mục',
            'position.required'         => 'Vui lòng nhập vị trí',
            'name_category.unique'      => 'Tên danh mục đã tồn tại',
            'position.unique'           => 'Vị trí đã tồn tại',
        ];
    }
}
