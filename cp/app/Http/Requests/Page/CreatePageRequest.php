<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\Request;

class CreatePageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'name' => 'required|regex:/^[a-zA-Z0-9\- _\.]+$/',
			'slug' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:pages,slug'
        ];
    }
}
