<?php

namespace App\Http\Requests\Quote;

use App\Models\User;
use App\Models\Currency\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class QuoteStoreRequest extends FormRequest
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
        $customer=User::where([['slug', $this->customer_source_id], ['state', '1']])->first();
        $currency=Currency::where([['slug', $this->currency_source_id], ['state', '1']])->first();
        $customers=User::role(['Cliente'])->where('state', '1')->get()->pluck('slug');
        $customers_destination=User::role(['Cliente'])->where([['id', '!=', $customer->id ?? NULL], ['state', '1']])->get()->pluck('slug');
        $currencies=Currency::where('state', '1')->get()->pluck('slug');
        $currencies_destination=Currency::where([['id', '!=', $currency->id ?? NULL], ['state', '1']])->get()->pluck('slug');
        return [
            'customer_source_id' => 'required|'.Rule::in($customers),
            'customer_destination_id' => 'required|'.Rule::in($customers_destination),
            'currency_source_id' => 'required|'.Rule::in($currencies),
            'currency_destination_id' => 'required|'.Rule::in($currencies_destination),
            'reason' => 'required|string|min:2|max:1000',
            'type_operation' => 'required|'.Rule::in(['1', '2', '3']),
            'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0.01'
        ];
    }
}
