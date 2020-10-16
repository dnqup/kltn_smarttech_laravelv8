<?php

namespace App\Http\Requests\admin\categorie;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieRequest extends FormRequest
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
            'categorie_name' => 'required|unique:categories|max:30',
        ];
    }

    public function messages()
    {
        return [
            'categorie_name.required' => 'Tên danh mục không được để trống',
            'categorie_name.unique' => 'Tên danh mục đã tồn tại',
            'categorie_name.max' => 'Tên danh mục chỉ được tối đa 30 ký tự',
            
        ];
    }
}
