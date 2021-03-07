<?php

namespace App\Http\Requests\Character;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
            ]
        ];
    }

    public function name(): ?string
    {
        return $this->input('name');
    }
}
