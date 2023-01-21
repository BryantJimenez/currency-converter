<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'fixed_commission' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'percentage_commission' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|max:100',
            'iva' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0|max:100'
        ];
    }
}
