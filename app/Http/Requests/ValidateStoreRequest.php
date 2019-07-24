<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateStoreRequest extends FormRequest
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
            'name'=>'required|string|max:20',
            'email'=>'required|email',
            'password'=>'required|min:5',
            'address'=>'required',
            'profile_image'=>'required|image|mimes:png,jpg,gif|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Nhập tên người dùng',
            'name.string'=>'Tên người dùng là kí tự',
            'name.max'=>'Tên người dùng không được quá 20 kí tự',
            'email.required'=>'Nhập vào email',
            'email.email'=>'Phải là email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất là 5 kí tự',
            'address.required'=>'Vui lòng nhập vào địa chỉ người dùng'
        ];
    }
}
