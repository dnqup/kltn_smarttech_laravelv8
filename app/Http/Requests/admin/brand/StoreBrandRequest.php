<?php

namespace App\Http\Requests\admin\brand;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            //
            'brand_name' => 'required|unique:brands|max:30',
            'image'=>'required|unique:brands|mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' => 'Tên nhãn hiệu không được để trống',
            'brand_name.unique' => 'Tên nhãn hiệu đã tồn tại',
            'brand_name.max' => 'Tên nhãn hiệu chỉ được tối đa 30 ký tự',
            'image.required' => 'Hình ảnh nhãn hiệu không được để trống',
            'image.mimes' => 'Hình ảnh nhãn hiệu chỉ được định dạng kiểu jpeg, jpg, png',
        ];
    }
}
