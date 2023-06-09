<?php

namespace App\Api\V1\Aplicacao\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

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
            'idAplicacao' => $inputs['idAplicacao'] ?? '',
            'clienteToken' => $inputs['clienteToken'] ?? ''
        ], $this->rules()[$method]);

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode([
                'erros' => [$validation->errors()]
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
                'idCliente' => 'required|integer|exists:cliente,id',
                'nome' => 'required|string',
            ],
            'update' => [
                'idAplicacao' => 'required|integer|exists:aplicacao,id',
                'nome' => 'required|string',
            ],
            'delete' => [
                'clienteToken' => 'required|string|exists:cliente,token',
                'idAplicacao' => [
                    'required', 'integer', 'exists:aplicacao,id', function ($attribute, $value, $fail) {
                        if ((Db::table('monitoramento')->where('id_aplicacao', $value)->get()->first()['id'] ?? null)) {
                            $fail('O registro não pode ser excluído, pois o id_aplicacao existe na tabela de monitoramento.');
                        }
                    }
                ],
            ]
        ];
    }
}
