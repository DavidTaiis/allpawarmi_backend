<?php

namespace App\Validators;

use App\Models\User;
use Illuminate\Validation\Rule;

/**
 * Class LoginValidator
 * @package App\Validators
 */
class UserValidator extends BaseValidator
{

    /**
     * @param array $dataIds
     */
    public function register($input)
    {
        $rule = [
            'name' => [
                'required',
            ],
            'identification_card' => [
                'required'
            ],
            'role' => [
                'required'
            ],
            'phone_number' => [
                'required'
            ],
            'password' => [
                'required'
            ]

        ];

        $this->validate($input, $rule);

    }

}
