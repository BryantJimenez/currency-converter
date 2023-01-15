<?php

namespace App\Http\Requests\Customer;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
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
        $countries=Country::all()->pluck('code');
        $account=($this->account_question=='1') ? true : false;
        $country=Country::where('code', $this->country_id)->first();
        $country_id=(!is_null($country)) ? $country->id : NULL;
        return [
            'photo' => 'nullable|file|mimetypes:image/*',
            'name' => 'required|string|min:2|max:191',
            'lastname' => 'required|string|min:2|max:191',
            'dni' => 'required|string|min:1|max:20|'.Rule::unique('users', 'dni')->where('country_id', $country_id),
            'email' => 'nullable|string|email|max:191|unique:users,email',
            'phone' => 'required|string|min:5|max:15',
            'address' => 'required|string|min:2|max:191',
            'country_id' => 'required|'.Rule::in($countries),
            'account_question' => 'required|'.Rule::in(['0', '1']),
            'bank' => Rule::requiredIf($account).'|string|min:2|max:191',
            'number' => Rule::requiredIf($account).'|string|min:2|max:191'
        ];
    }
}
