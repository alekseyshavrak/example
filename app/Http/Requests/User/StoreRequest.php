<?php

namespace App\Http\Requests\User;

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
            'name'        => ['required', 'string', 'max:255'],
            'surname'     => ['required', 'string', 'max:255'],
            'offer'       => [],
            'description' => [],
            'hometown'    => ['string', 'max:250'],
            'location'    => ['string', 'max:250'],
            'birthday'    => ['date'],
        ];
    }
}
