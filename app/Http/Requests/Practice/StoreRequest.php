<?php

namespace App\Http\Requests\Practice;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required', 'exists:practice_categories,id'],
            'title'       => ['required', 'string', 'max:255'],
        ];
    }
}
