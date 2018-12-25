<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\Request;

class UpdatePageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	$page = $this->route('slug');
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9\- _\.]+$/',
			'slug' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:pages,slug,' . $page->id
        ];
    }
}
