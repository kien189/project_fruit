<?php

namespace App\Http\Requests\Login_Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:6|max:100',
            'email' => 'required|min:6|max:100|email|unique:customers',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng điền họ tên',
            'name.min' => 'Họ tên phải có ít nhất 6 ký tự',
            'name.max' => 'Họ tên không được vượt quá 100 ký tự',
            'email.required' => 'Email không được để trống',
            'email.min' => 'Email phải có ít nhất 6 ký tự',
            'email.email' => 'Email phải đúng định dạng example@gmail.com',
            'email.max' => 'Email không được vượt quá 100 ký tự',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không khớp',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
            'confirm_password.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự',
            'confirm_password.same' => 'Mật khẩu và xác nhận mật khẩu không khớp',
        ];
    }


}
