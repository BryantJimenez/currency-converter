<?php

namespace App\Http\Requests\Quote;

use App\Models\User;
use App\Models\Account;
use App\Models\Currency\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class QuoteUpdateRequest extends FormRequest
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
        $customer_destination=User::where([['slug', $this->customer_destination_id], ['state', '1']])->first();
        $currency=Currency::where([['slug', $this->currency_source_id], ['state', '1']])->first();
        $customers=User::where([['user_role', 'Cliente'], ['state', '1']])->get()->pluck('slug');
        $customers_destination=User::where([['id', '!=', $customer->id ?? NULL], ['user_role', 'Cliente'], ['state', '1']])->get()->pluck('slug');
        $currencies=Currency::where('state', '1')->get()->pluck('slug');
        $currencies_destination=Currency::where([['id', '!=', $currency->id ?? NULL], ['state', '1']])->get()->pluck('slug');
        $accounts_destination=Account::where([['user_id', $customer_destination->id ?? NULL], ['state', '1']])->get()->pluck('slug');
        $state_payment=(Auth::user()->can('quotes.input.state_payment')) ? true : false;
        return [
            'customer_source_id' => 'required|'.Rule::in($customers),
            'customer_destination_id' => 'required|'.Rule::in($customers_destination),
            'account_destination_id' => 'required|'.Rule::in($accounts_destination),
            'currency_source_id' => 'required|'.Rule::in($currencies),
            'currency_destination_id' => 'required|'.Rule::in($currencies_destination),
            'reason' => 'required|string|min:2|max:1000',
            'type_operation' => 'required|'.Rule::in(['1', '2', '3']),
            'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0.01',
            'state_payment' => Rule::requiredIf($state_payment).'|'.Rule::in(['1', '2', '3'])
        ];
    }
}
