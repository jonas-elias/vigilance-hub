<?php

namespace App\Api\V1\Monitoramento\Log\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class LogValidation
 */
class LogValidation extends Validator
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
            'mensagem' => $inputs['mensagem'] ?? '',
            'idLog' => $inputs['idLog'] ?? ''
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
                'mensagem' => 'required|string|max:4096'
            ],
            'update' => [
                'idLog' => 'required|integer|exists:log,id',
                'nivel' => 'required|string|max:10',
                'mensagem' => 'required|string|max:4096'
            ]
        ];
    }
}
