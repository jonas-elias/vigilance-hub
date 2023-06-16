<?php

namespace App\Api\V1\Monitoramento\Cache\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class CacheValidation
 */
class CacheValidation extends Validator
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
            'idMonitoramento' => $inputs['idMonitoramento'],
            'chave' => $inputs['chave'],
            'acao' => $inputs['acao']
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
            'idMonitoramento' => 'required|integer|exists:monitoramento,id',
            'chave' => 'required|string|max:255',
            'acao' => 'required|string|max:6'
        ];
    }
}
