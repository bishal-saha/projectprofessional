<?php

namespace App\Http\Requests\Permission;

class UpdatePermissionRequest extends BasePermissionRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $permission = $this->route('permission');

        return [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:permissions,name,' . $permission->id
        ];
    }
}
