<?php

namespace App\Http\Requests\File;

use App\Http\Requests\Request;

class StoreImageRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'in:user.avatar'],
            'file' => ['required', 'image', 'max:102400'],
        ];
    }
}
