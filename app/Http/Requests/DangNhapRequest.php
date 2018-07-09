<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangNhapRequest extends FormRequest
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
        $this->session()->flash('loiDangNhap','loi dang nhap');
        return [
            'email'=> 'required|email',
            'password'=> 'required|max:30|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=> 'Vui long nhap email',
            'email.email'=> 'Khong dung dinh dang email, vui long nhap lai',
            'password.required'=> 'Vui long nhap mat khau',
            'password.min'=> 'Mat khau toi thieu 6 ky tu',
            'password.max'=> 'Mat khau toi da 30 ky ty',
        ];
    }
}
