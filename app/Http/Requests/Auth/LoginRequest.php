<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // $this->request->set('phone', preg_replace('/[^0-9]/', '', $this->get('phone')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'   => ['required'],
        ];
    }
}
