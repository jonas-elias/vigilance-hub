<?php

namespace App\Api\V1\Usuario\Cliente\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class ClienteValidation
 */
class ClienteValidation extends Validator
{
    /**
     * Method to validation inputs cliente usuario
     *
     * @param array $inputs
     * @return void
     */
    public function validate(array $inputs): void
    {
        $validation = $this->validator->make([
            'userId' => $inputs['userId'],
        ], $this->rules());

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode($validation->errors()));
        }
    }

    /**
     * Method with rules of the class
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'userId' => 'required|integer|exists:usuario,id'
        ];
    }
}
