<?php

namespace App\Http\Requests\User\Request;

use App\Http\Requests\Request;


class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'request'      => ['required', 'array'],
            'request.*'    => ['exists:practices,id'],
        ];
    }
}
