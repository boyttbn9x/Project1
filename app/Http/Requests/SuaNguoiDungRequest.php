<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuaNguoiDungRequest extends FormRequest
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
        if ($this->checkpassword == "on") {
            return [
                'hoten'=>'required',
                'sodienthoai'=>'required|numeric',
                'password'=>'required|min:6|max:30',
                'passwordAgain' =>'required|same:password',
            ];   
        }else{
            return[
                'hoten'=>'required',
                'sodienthoai'=>'required|numeric',
            ];
        }    
    }

    public function messages()
    {
        return [
            'hoten.required'=>'Vui long nhap ho ten',
            'sodienthoai.required'=>'Vui long nhap so dien thoai',
            'sodienthoai.numeric'=>'So dien thoai la 1 day so',
            'password.required' => 'Bạn chưa nhập mật khẩu moi',
            'password.min' => 'Mật khẩu moi toi thieu 6 kí tự',
            'password.max' => 'Mật khẩu moi tối đa 30 kí tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Xac nhan mat khau moi khong đúng',  
        ];
    }
}
