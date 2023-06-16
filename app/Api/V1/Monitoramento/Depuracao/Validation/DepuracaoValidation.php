<?php

namespace App\Api\V1\Monitoramento\Depuracao\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class DepuracaoValidation
 */
class DepuracaoValidation extends Validator
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
            'depuracao' => $inputs['depuracao'],
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
            'depuracao' => 'required|string|max:4096',
        ];
    }
}
