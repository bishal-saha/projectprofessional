<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;

class CreateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
			'role_id' => 'required|exists:roles,id',
			'birthday' => 'nullable|date',
			'email' => 'required|email|unique:users,email',
            'username' => 'nullable|unique:users,username',
            'password' => 'required|min:6|confirmed',


        ];

        if ($this->get('country_id')) {
            $rules += ['country_id' => 'exists:countries,id'];
        }

        return $rules;
    }
}
