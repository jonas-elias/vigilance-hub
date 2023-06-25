<?php

declare(strict_types=1);

namespace App\Api\V1\Monitoramento\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class MonitoramentoValidation
 */
class MonitoramentoValidation extends Validator
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
            'clienteToken' => $inputs['clienteToken'] ?? '',
            'aplicacaoToken' => $inputs['aplicacaoToken'] ?? '',
            'idMonitoramento' => $inputs['idMonitoramento'] ?? ''
        ], $this->rules()[$method]);

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode([
                'erros' => [
                    $validation->errors()
                ]
            ]));
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
                'clienteToken' => 'required|string|exists:cliente,token',
                'aplicacaoToken' => 'required|string|exists:aplicacao,token'
            ],
            'delete' => [
                'idMonitoramento' => 'required|integer|exists:monitoramento,id'
            ],
            'update' => [
                'clienteToken' => 'required|string|exists:cliente,token',
                'aplicacaoToken' => 'required|string|exists:aplicacao,token'
            ]
        ];
    }
}
