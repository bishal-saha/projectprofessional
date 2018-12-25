<?php

namespace App\Http\Requests\Auth;


use App\Http\Requests\Request;

class PasswordResetRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|exists:users,email',
            'password' => 'required|confirmed|min:6'
        ];
    }

	public function messages()
	{
		return [
			'email.exists' => "We can't find a user with that e-mail address."
		];
	}
}