<?php

namespace App\Http\Requests\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $roles=Role::where('name', '!=', 'Cliente')->pluck('name');
        $custom_permissions=($this->custom_permissions=='1') ? true : false;
        $permissions=Permission::where('name', '!=', 'dashboard')->pluck('name');
        return [
            'photo' => 'nullable|file|mimetypes:image/*',
            'name' => 'required|string|min:2|max:191',
            'lastname' => 'required|string|min:2|max:191',
            'phone' => 'required|string|min:5|max:15',
            'type' => 'required|'.Rule::in($roles),
            'state' => 'required|'.Rule::in(['0', '1']),
            'custom_permissions' => 'required|'.Rule::in(['0', '1']),
            'permission_id' => Rule::requiredIf($custom_permissions).'|array',
            'permission_id.*' => 'required|'.Rule::in($permissions)
        ];
    }
}
