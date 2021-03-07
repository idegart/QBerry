<?php

namespace App\Http\Requests\Quote;

use App\Models\Character;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RandomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'author' => [
                'required',
                Rule::exists((new Character)->getTable(), 'name'),
            ],
        ];
    }

    public function author(): string
    {
        return $this->input('author');
    }
}
