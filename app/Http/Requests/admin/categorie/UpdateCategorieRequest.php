<?php

namespace App\Http\Requests\admin\categorie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategorieRequest extends FormRequest
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
            'categorie_name' => [
                'required',
                'max:30',
                Rule::unique('categories')->ignore($this->id),
            ],
            
            
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
