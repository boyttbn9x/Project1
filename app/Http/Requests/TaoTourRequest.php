<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaoTourRequest extends FormRequest
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
        if(!isset($this->tmp)){
            return [
                'tentour'=>'required',
                'sokhachtoida'=>'required|integer',
                'songaydi'=>'required|integer',
                'giatour'=>'required|integer',
                'mota'=>'required',
            ];
        }else{
            return[];
        }
    }

    public function messages()
    {
       return [
            'tentour.required'=>'Vui long nhap ten tour',
            'sokhachtoida.required'=>'Vui long nhap so khach toi da',
            'sokhachtoida.integer'=>'So khach toi da la 1 con so',
            'songaydi.required'=>'Vui long nhap so ngay di',
            'songaydi.integer'=>'So ngay di la 1 con so',
            'giatour.required'=>'Vui long nhap gia tour',
            'giatour.integer'=>'Gia tien la 1 con so',
            'mota.required'=>'Vui long nhap mo ta',
        ]; 
    }
}
