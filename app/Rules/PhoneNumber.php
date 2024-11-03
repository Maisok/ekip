<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Проверка формата номера телефона 8 888 888 88 88
        return preg_match('/^8 \d{3} \d{3} \d{2} \d{2}$/', $value);
    }

    public function message()
    {
        return 'The :attribute must be in the format 8 888 888 88 88.';
    }
}