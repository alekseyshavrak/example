<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use Illuminate\Support\Str;

class RegistrationRequest extends Request
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->request->set('phone', Str::of($this->get('phone'))
            ->replaceMatches('/[^0-9]++/', '')
            ->trim());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'    => ['required', 'unique:users'],
            'password' => ['required', 'min:6'],
            'name'     => ['required', 'string', 'max:255'],
            'surname'  => ['required', 'string', 'max:255'],
        ];
    }
}
