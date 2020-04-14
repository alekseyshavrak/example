<?php

namespace App\Http\Requests\User\Avatar;

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
            'file_id' => ['required', 'exists:files,id'],
        ];
    }
}
