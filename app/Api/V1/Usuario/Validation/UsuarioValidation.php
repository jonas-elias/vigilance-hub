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
     * @param string $method
     * @return void
     */
    public function validate(array $inputs, ?string $method = null): void
    {
        $validation = $this->validator->make([
            'nome' => $inputs['nome'] ?? '',
            'email' => $inputs['email'] ?? '',
            'senha' => $inputs['senha'] ?? '',
            'isAdmin' => $inputs['isAdmin'] ?? ''
        ], $this->rules()[$method]);

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode([
                'erros' => [$validation->errors()]
            ]));
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
            'update' => [
                'nome' => 'required|string|max:255',
                'email' => 'required|string|email|unique:usuario,email|max:255',
            ],
            'insert' => [
                'nome' => 'required|string|max:255',
                'email' => 'required|string|email|unique:usuario,email|max:255',
                'senha' => 'required|string|min:4|max:255',
                'isAdmin' => 'required|boolean'
            ]
        ];
    }
}
