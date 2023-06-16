<?php

namespace App\Api\V1\Monitoramento\Query\Validation;

use App\Api\V1\Validator\Validator;

/**
 * class QueryValidation
 */
class QueryValidation extends Validator
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
            'duracao' => $inputs['duracao'],
            'conector' => $inputs['conector'],
            'localizacao' => $inputs['localizacao'],
            'query' => $inputs['query']
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
            'duracao' => 'required|numeric',
            'conector' => 'required|string|max:10',
            'localizacao' => 'required|string|max:255',
            'query' => 'required|string|max:8192'
        ];
    }
}
