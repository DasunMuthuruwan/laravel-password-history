<?php

namespace DevDasun\PasswordHistory\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class DifferentFromHistory implements ValidationRule
{
    /**
     * validate password history
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();

        if ($user && method_exists($user, 'passwordWasUsedBefore') && $user->passwordWasUsedBefore($value)) {
            $fail(trans('password-history::messages.reused', [
                'count' => config('password-history.limit', 5),
            ]));
        }
    }
}