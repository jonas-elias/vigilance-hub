<?php

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
     * @return void
     */
    public function validate(array $inputs): void
    {
        $validation = $this->validator->make([
            'clienteToken' => $inputs['clienteToken'],
            'aplicacaoToken' => $inputs['aplicacaoToken']
        ], $this->rules());

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
            'clienteToken' => 'required|string|exists:cliente,token',
            'aplicacaoToken' => 'required|string|exists:aplicacao,token'
        ];
    }
}
