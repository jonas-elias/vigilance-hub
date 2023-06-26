<?php

namespace App\Api\V1\Monitoramento\Cache\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class CacheValidation
 */
class CacheValidation extends Validator
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
            'chave' => $inputs['chave'] ?? '',
            'acao' => $inputs['acao'] ?? '',
            'idCache' => $inputs['idCache'] ?? '',
            'credenciais' => $inputs['credenciais'] ?? ''
        ], $this->rules()[$method]);

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode(['erros' => [
                $validation->errors()
            ]]));
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
                'chave' => 'required|string|max:255',
                'acao' => 'required|string|max:6'
            ],
            'update' => [
                'chave' => 'required|string|max:255',
                'acao' => 'required|string|max:6',
                'idCache' => 'required|integer|exists:cache,id',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('cache as c')
                        ->join('monitoramento as m', 'c.id_monitoramento', '=', 'm.id')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('c.id', $value['idCache'])
                        ->get('c.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode alterar o monitoramento de cache a partir do token de outra aplicação.');
                    }
                }]
            ]
        ];
    }
}
