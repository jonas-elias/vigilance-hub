<?php

declare(strict_types=1);

namespace App\Api\V1\Monitoramento\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

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
            'idMonitoramento' => $inputs['idMonitoramento'] ?? '',
            'credenciais' => $inputs['credenciais'] ?? ''
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
                'idMonitoramento' => 'required|integer|exists:monitoramento,id',
                'clienteToken' => 'required|string|exists:cliente,token',
                'aplicacaoToken' => 'required|string|exists:aplicacao,token',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('monitoramento as m')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('m.id', $value['idMonitoramento'])
                        ->get('m.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode deletar o monitoramento de recursos a partir do token de outra aplicação.');
                    }
                }]
            ],
            'update' => [
                'clienteToken' => 'required|string|exists:cliente,token',
                'aplicacaoToken' => 'required|string|exists:aplicacao,token'
            ],
            'getTotalAplicacoes' => [
                'clienteToken' => 'required|string|exists:cliente,token',
            ],
            'getTotalMonitoramentos' => [
                'clienteToken' => 'required|string|exists:cliente,token',
                'aplicacaoToken' => 'required|string|exists:aplicacao,token',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('aplicacao as a')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->get('a.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não está acessando o recurso com chaves válidas.');
                    }
                }],
            ],
            'getTotalMonitoramentoData' => [
                'clienteToken' => 'required|string|exists:cliente,token',
                'aplicacaoToken' => 'required|string|exists:aplicacao,token',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('aplicacao as a')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->get('a.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não está acessando o recurso com chaves válidas.');
                    }
                }],
            ],
        ];
    }
}
