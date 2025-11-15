<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateYandexUrlRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    if (!str_starts_with($value, 'https://yandex')) {
                        $fail($attribute . ' must start with https://yandex');
                    }

                    if (!str_contains($value, '/org/')) {
                        $fail($attribute . ' must contain /org/');
                    }

                    if (!str_contains($value, '/reviews/')) {
                        $fail($attribute . ' must contain /reviews/');
                    }
                },
            ],
        ];
    }

}
