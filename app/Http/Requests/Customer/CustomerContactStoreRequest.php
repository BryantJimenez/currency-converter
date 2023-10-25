<?php

namespace App\Http\Requests\Customer;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerContactStoreRequest extends FormRequest
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
        $customers=User::where([['id', '!=', $this->user->id], ['user_role', 'Cliente'], ['state', '1']])->pluck('slug');
        return [
            'user_alias' => 'required|string|min:2|max:191',
            'destination_alias' => 'required|string|min:2|max:191',
            'customer_id' => 'required|'.Rule::in($customers)
        ];
    }
}
