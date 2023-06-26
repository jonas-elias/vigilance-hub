<?php

namespace App\Api\V1\Monitoramento\Log\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class LogValidation
 */
class LogValidation extends Validator
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
            'nivel' => $inputs['nivel'] ?? '',
            'mensagem' => $inputs['mensagem'] ?? '',
            'idLog' => $inputs['idLog'] ?? '',
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
                'nivel' => 'required|string|max:10',
                'mensagem' => 'required|string|max:4096'
            ],
            'update' => [
                'idLog' => 'required|integer|exists:log,id',
                'nivel' => 'required|string|max:10',
                'mensagem' => 'required|string|max:4096',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('log as l')
                        ->join('monitoramento as m', 'l.id_monitoramento', '=', 'm.id')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('l.id', $value['idLog'])
                        ->get('l.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode alterar o monitoramento de log a partir do token de outra aplicação.');
                    }
                }]
            ]
        ];
    }
}
