<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangKyHDVRequest extends FormRequest
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
        $this->session()->flash('loiDangKyHDV','loi dang ky');
        return [
            'hoten'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|max:30|min:6',
            'passwordAgain'=> 'same:password',
            'sodienthoai'=> 'required|integer',
            'diachi'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'hoten.required'=> 'Vui long nhap ho ten',
            'email.required'=> 'Vui long nhap email',
            'email.email'=> 'Khong dung dinh dang email, vui long nhap lai',
            'email.unique'=> 'Email nay da co nguoi su dung',
            'password.required'=> 'Vui long nhap mat khau',
            'password.min'=> 'Mat khau toi thieu 6 ky tu',
            'password.max'=> 'Mat khau toi da 30 ky ty',
            'passwordAgain.same'=> 'Mat khau xac nhan khong hop le',
            'sodienthoai.required'=> 'Vui long nhap so dien thoai',
            'sodienthoai.integer'=> 'So dien thoai la 1 day so',
            'diachi.required'=> 'Vui long nhap dia chi',
        ];
    }
}
