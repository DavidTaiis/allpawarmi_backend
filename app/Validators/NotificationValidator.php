<?php

namespace App\Validators;
use Illuminate\Validation\Rule;

/**
 * Class LoginValidator
 * @package App\Validators
 */
class NotificationValidator extends BaseValidator
{

    public function addNotification($input)
    {
        $rule = [
            'lng' => [
                'required',
            ],
            'lat' => [
                'required',
            ],
        ];
        $this->validate($input, $rule);

    }

}
