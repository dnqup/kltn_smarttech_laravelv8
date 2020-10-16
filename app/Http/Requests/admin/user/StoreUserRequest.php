<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:50',
            'image'=>'unique:users|mimes:jpeg,jpg,png,JPEG,JPG,PNG',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|min:8',
            'phone'=> 'required|numeric',
            'address' => 'required|max:255',
            'role' => 'required'
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để trống',
            'name.max' => 'Họ tên chỉ được tối đa 50 ký tự',
            'image.mimes' => 'Ảnh chỉ được định dạng kiểu jpeg, jpg, png',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Định dạng email không đúng',
            'email.max' => 'Email chỉ được tối đa 50 ký tự',
            'password.required' => 'Password không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại chỉ được định dạng kiếu số (0-9)',
            'address.required' => 'Địa chỉ không được để trống',
            'address.max' => 'Địa chỉ chỉ được tối đa 255 ký tự',
            'role.required' => 'Phần quyền không được để trống',
        ];
    }
}
