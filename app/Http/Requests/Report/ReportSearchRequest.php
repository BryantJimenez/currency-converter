<?php

namespace App\Http\Requests\Report;

use App\Models\User;
use App\Models\Currency\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReportSearchRequest extends FormRequest
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
        $start=(!is_null($this->start)) ? '|after_or_equal:start' : '';
        $end=(!is_null($this->end)) ? '|before_or_equal:end' : '';
        $currencies=Currency::where('state', '1')->get()->pluck('slug');
        $users=User::where('user_role', '!=', 'Cliente')->get()->pluck('slug');
        return [
            'user_id' => 'nullable|'.Rule::in($users),
            'start' => 'required|date_format:"d-m-Y"'.$end,
            'end' => 'required|date_format:"d-m-Y"'.$start,
            'currency_id' => 'required|'.Rule::in($currencies),
            'type' => 'required|'.Rule::in('1', '2')
        ];
    }
}
