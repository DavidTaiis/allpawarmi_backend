<?php

namespace App\Validators;

use App\Models\Product;
use App\Rules\ValidationPoints;
use Illuminate\Validation\Rule;


class RedeemedProductsValidator extends BaseValidator
{
    /**
     * @param $data
     * @param $companyId
     */
    public function validateStructure($data, $companyId)
    {
        $input = [
            'products' => $data
        ];

        $rule = [
            "products.*.productId" => [
                'required',
                Rule::exists('product', 'id')
                    ->where('company_id', $companyId)
                    ->where('status', Product::STATUS_ACTIVE)
            ]
        ];

        $this->validate($input, $rule);
    }

    public function validatePoints($data)
    {
        $input = [
            'products' => $data
        ];
        $rule = [
            'products' => new ValidationPoints(),

        ];

        $this->validate($input, $rule);


    }
    public function validateUser($userId)
    {
        
        $input = [
            'userId' => $userId
        ];
        $rule = [
            'userId' => Rule::exists('users', 'id')
            ->where('status', Product::STATUS_ACTIVE)
        ];
        $messages = [
            'userId.exists'  => 'El usuario se encuentra inactivo'
        ];
        $this->validate($input, $rule , $messages);
    }
}
