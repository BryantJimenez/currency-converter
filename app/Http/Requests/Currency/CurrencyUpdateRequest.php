<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CurrencyUpdateRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:191|'.Rule::unique('currencies', 'name')->ignore($this->currency->id),
            'iso' => 'required|string|min:3|max:3|'.Rule::unique('currencies', 'iso')->ignore($this->currency->id),
            'symbol' => 'required|string|min:1|max:3',
            'side' => 'required|'.Rule::in(['1', '2'])
        ];
    }
}
