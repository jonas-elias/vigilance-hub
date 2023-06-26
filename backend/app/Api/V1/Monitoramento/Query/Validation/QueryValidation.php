<?php

namespace App\Api\V1\Monitoramento\Query\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class QueryValidation
 */
class QueryValidation extends Validator
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
            'duracao' => $inputs['duracao'] ?? '',
            'conector' => $inputs['conector'] ?? '',
            'localizacao' => $inputs['localizacao'] ?? '',
            'query' => $inputs['query'] ?? '',
            'idQuery' => $inputs['idQuery'] ?? '',
            'credenciais' => $inputs['credenciais'] ?? ''
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
                'idMonitoramento' => 'required|integer|exists:monitoramento,id',
                'duracao' => 'required|numeric',
                'conector' => 'required|string|max:10',
                'localizacao' => 'required|string|max:255',
                'query' => 'required|string|max:8192'
            ],
            'update' => [
                'idQuery' => 'required|integer|exists:query,id',
                'duracao' => 'required|numeric',
                'conector' => 'required|string|max:10',
                'localizacao' => 'required|string|max:255',
                'query' => 'required|string|max:8192',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('query as q')
                        ->join('monitoramento as m', 'q.id_monitoramento', '=', 'm.id')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('q.id', $value['idQuery'])
                        ->get('q.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode alterar o monitoramento de query a partir do token de outra aplicação.');
                    }
                }]
            ]
        ];
    }
}
