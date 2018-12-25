<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use App\Rules\ReCaptcha;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:6',
        ];

        if (appSettings('registration.captcha.enabled')) {
			$rules['g-recaptcha-response'] = ['required', new ReCaptcha()];
        }

        if (appSettings('tos')) {
            $rules['tos'] = 'accepted';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tos.accepted' => 'You have to accept Terms of Service.'
        ];
    }
}
