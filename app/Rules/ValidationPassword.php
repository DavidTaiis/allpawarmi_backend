<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ValidationPassword implements Rule
{
    private $identification_card;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($identification_card)
    {
        $this->identification_card = $identification_card;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('identification_card', $this->identification_card)
            ->first();
        if ($user && Hash::check($value, $user->password)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Contraseña incorrecta';
    }
}
