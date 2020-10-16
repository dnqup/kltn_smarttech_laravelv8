<?php

namespace App\Http\Requests\admin\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'product_name' => [
                'required',
                'max:100',
                Rule::unique('products')->ignore($this->id),
            ],
            
            'image'=>'mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'description' => '',
            'price' => 'required|numeric',
            'promotion_price' => 'required|numeric',
            'id_categorie' => 'required',
            'id_brand' => 'required',
            
            
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'product_name.unique' => 'Tên sản phẩm đã tồn tại',
            'product_name.max' => 'Tên sản phẩm chỉ được tối đa 100 ký tự',
            'image.mimes' => 'Hình ảnh chỉ được định dạng kiểu jpeg, jpg, png',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá chỉ được đinh dạng kiểu số (0-9)',
            'promotion_price.required' => 'Giá khuyến mãi không được để trống',
            'promotion_price.numeric' => 'Giá khuyến mãi chỉ được đinh dạng kiểu số (0-9)',
            'id_categorie.required' => 'Danh mục không được để trống',
            'id_brand.required' => 'Nhãn hiệu không được để trống',
            
        ];
    }
}
