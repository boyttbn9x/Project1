<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangKyRequest extends FormRequest
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
        $this->session()->flash('loiDangKyKhach','loi dang ky');
        return [
            'hoten'=>'required',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|max:30|min:6',
            'passwordAgain'=> 'same:password',
            'sodienthoai'=>'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'hoten.required'=>'Vui long nhap Ho ten',
            'email.required'=>'Vui long nhap Email',
            'email.email'=>'Dinh dang email khong dung, vui long nhap lai',
            'email.unique'=>'Email nay da co nguoi su dung',
            'password.required'=>'Vui long nhap password',
            'password.max'=>'Password toi da 30 ky tu',
            'password.min'=>'Password toi thieu 6 ky tu',
            'passwordAgain.same'=>'Mat khau xac nhan khong hop le',
            'sodienthoai.required'=>'Vui long nhap so dien thoai',
            'sodienthoai.numeric'=> 'So dien thoai la 1 day so'
        ];
    }
}
