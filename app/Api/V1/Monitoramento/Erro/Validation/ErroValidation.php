<?php

namespace App\Api\V1\Monitoramento\Erro\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class ErroValidation
 */
class ErroValidation extends Validator
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
            'idMonitoramento' => $inputs['idMonitoramento'] ?? '',
            'nivel' => $inputs['nivel'] ?? '',
            'localizacao' => $inputs['localizacao'] ?? '',
            'stacktrace' => $inputs['stacktrace'] ?? '',
            'idErro' => $inputs['idErro']
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
                'idMonitoramento' => 'required|integer|exists:monitoramento,id',
                'nivel' => 'required|string|max:10',
                'localizacao' => 'required|string|max:255',
                'stacktrace' => 'required|string|max:8192'
            ],
            'update' => [
                'idErro' => 'required|integer|exists:erro,id',
                'nivel' => 'required|string|max:10',
                'localizacao' => 'required|string|max:255',
                'stacktrace' => 'required|string|max:8192'
            ]
        ];
    }
}
