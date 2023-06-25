<?php

namespace App\Api\V1\Usuario\Admin\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class AdminValidation
 */
class AdminValidation extends Validator
{
    /**
     * Method to validation inputs admin usuario
     *
     * @param array $inputs
     * @param ?string $method = null
     * @return void
     */
    public function validate(array $inputs, ?string $method = null): void
    {
        $validation = $this->validator->make([
            'userId' => $inputs['userId'] ?? '',
            'idAdmin' => $inputs['idAdmin'] ?? ''
        ], $this->rules()[$method]);

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
            'insert' => [
                'userId' => 'required|integer|exists:usuario,id'
            ],
            'delete' => [
                'idAdmin' => 'required|integer|exists:admin,id'
            ]
        ];
    }
}
