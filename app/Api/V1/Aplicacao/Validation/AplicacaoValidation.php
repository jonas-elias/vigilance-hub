<?php

namespace App\Api\V1\Aplicacao\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class AplicacaoValidation
 */
class AplicacaoValidation extends Validator
{
    /**
     * Method to validate application inputs
     *
     * @param array $inputs
     * @param ?string $method = null
     * @return void
     */
    public function validate(array $inputs, ?string $method = null): void
    {
        $validation = $this->validator->make([
            'idCliente' => $inputs['idCliente'] ?? '',
            'nome' => $inputs['nome'] ?? '',
            'idAplicacao' => $inputs['idAplicacao'] ?? ''
        ], $this->rules()[$method]);

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode($validation->errors()));
        }
    }

    /**
     * Method with the rules of the class
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'insert' => [
                'idCliente' => 'required|integer|exists:cliente,id',
                'nome' => 'required|string',
            ],
            'update' => [
                'idAplicacao' => 'required|integer|exists:aplicacao,id',
                'nome' => 'required|string',
            ]
        ];
    }
}
