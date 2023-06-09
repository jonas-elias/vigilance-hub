<?php

namespace App\Api\V1\Usuario\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class UsuarioValidation
 */
class UsuarioValidation extends Validator
{
    /**
     * Method to validation inputs usuario
     *
     * @param array $inputs
     * @return void
     */
    public function validate(array $inputs): void
    {
        $validation = $this->validator->make([
            'nome' => $inputs['nome'],
            'email' => $inputs['email'],
            'senha' => $inputs['senha'],
            'isAdmin' => $inputs['isAdmin']
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
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|unique:usuario,email|max:255',
            'senha' => 'required|string|max:255',
            'isAdmin' => 'required|boolean'
        ];
    }
}
