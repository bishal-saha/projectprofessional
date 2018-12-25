<?php

namespace App\Rules;

use App\Http\Requests\Request;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class ReCaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		$client = new Client();

		$response = $client->request('POST',
			'https://www.google.com/recaptcha/api/siteverify',
			['form_params' =>
				[
					'secret' => env('GOOGLE_RECAPTCHA_SECRETKEY'),
					'response' => $value,
					'remoteip' => Request::ip()
				]
			]
		);

		$body = json_decode((string)$response->getBody());
		session(['recaptcha' => $body]);
		return $body->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please ensure that you are a human!';
    }
}
