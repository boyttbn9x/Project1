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
        return [
            'tentour'=>'required',
            'sokhachmax'=>'required|integer',
            'giatour'=>'required|integer',
            'mota'=>'required',
        ];
    }

    public function messages()
    {
       return [
            'tentour.required'=>'Vui long nhap ten tour',
            'sokhachmax.required'=>'Vui long nhap so khach toi da',
            'sokhachmax.integer'=>'So khach max la 1 con so',
            'giatour.required'=>'Vui long nhap gia tour',
            'giatour.integer'=>'Gia tien la 1 con so',
            'mota.required'=>'Vui long nhap mo ta',
        ]; 
    }
}
