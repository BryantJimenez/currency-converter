<?php

namespace App\Http\Requests\Currency;

use App\Models\Currency\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CurrencyExchangeUpdateRequest extends FormRequest
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
        $currencies=Currency::where('id', '!=', $this->currency->id)->get()->pluck('slug');
        return [
            'conversion_rate' => 'required|array',
            'conversion_rate.*' => 'required|numeric|regex:/^\d+(\.\d{1,6})?$/|min:0',
            'currency_id' => 'required|array',
            'currency_id.*' => 'required|'.Rule::in($currencies)
        ];
    }
}
