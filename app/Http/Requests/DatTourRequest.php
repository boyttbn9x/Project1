<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatTourRequest extends FormRequest
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
        $this->session()->flash('errorDatTour', true);
        return [
            'timeBD'=>'required|date',
            'sokhachdangky'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'timeBD.required'=>'Vui long nhap thoi gian bat dau',
            'timeBD.date'=>'Khong dung dinh dang date',
            'sokhachdangky.required'=>'Vui long nhap so khach dang ky',
        ];
    }
}
