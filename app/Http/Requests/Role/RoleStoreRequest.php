<?php

namespace App\Http\Requests\Role;

use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
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
    $permissions=Permission::get()->pluck('name');
    return [
      'name' => 'required|string|min:2|max:191|unique:roles,name',
      'permission_id' => 'required|array',
      'permission_id.*' => 'required|'.Rule::in($permissions)
    ];
  }
}
