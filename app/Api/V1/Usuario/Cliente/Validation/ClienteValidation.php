<?php

namespace App\Api\V1\Usuario\Cliente\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class ClienteValidation
 */
class ClienteValidation extends Validator
{
    /**
     * Method to validation inputs cliente usuario
     *
     * @param array $inputs
     * @return void
     */
    public function validate(array $inputs, ?string $method = null): void
    {
        $validation = $this->validator->make([
            'userId' => $inputs['userId'] ?? '',
            'idCliente' => $inputs['idCliente'] ?? ''
        ], $this->rules()[$method]);

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
            'insert' => [
                'userId' =>
                'required|integer|exists:usuario,id'
            ],
            'delete' => [
                'idCliente' => [
                    'required', 'integer', 'exists:cliente,id', function ($attribute, $value, $fail) {
                        if ((Db::table('aplicacao')->where('id_cliente', $value)->get()->first()['id'] ?? null)) {
                            $fail('O registro não pode ser excluído, pois o id_cliente já existe na tabela de aplicação.');
                        }
                    }
                ]
            ]
        ];
    }
}
