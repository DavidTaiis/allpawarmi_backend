<?php

namespace App\Validators;
use Illuminate\Validation\Rule;

/**
 * Class LoginValidator
 * @package App\Validators
 */
class GeolocationMaValidator extends BaseValidator
{

    public function addGeolocation($input)
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
