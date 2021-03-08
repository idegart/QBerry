<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique((new User)->getTable(), 'email'),
            ],
            'name' => [
                'required',
            ],
            'password' => [
                'required',
            ],
            'device_name' => [
                'required',
            ],
        ];
    }
}
