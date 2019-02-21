<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Ismobile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //preg_match 返回0或1
        return !!preg_match('/^1[3|4|5|7|8]\d{9}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.ismobile');
    }
}
