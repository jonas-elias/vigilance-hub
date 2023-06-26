<?php

namespace App\Api\V1\Monitoramento\Erro\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class ErroValidation
 */
class ErroValidation extends Validator
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
            'localizacao' => $inputs['localizacao'] ?? '',
            'stacktrace' => $inputs['stacktrace'] ?? '',
            'idErro' => $inputs['idErro'] ?? '',
            'credenciais' => $inputs['credenciais'] ?? ''
        ], $this->rules()[$method]);

        if ($validation->fails()) {
            throw new \InvalidArgumentException(json_encode([
                'erro' => [$validation->errors()]
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
                'localizacao' => 'required|string|max:255',
                'stacktrace' => 'required|string|max:8192'
            ],
            'update' => [
                'idErro' => 'required|integer|exists:erro,id',
                'nivel' => 'required|string|max:10',
                'localizacao' => 'required|string|max:255',
                'stacktrace' => 'required|string|max:8192',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('erro as e')
                        ->join('monitoramento as m', 'e.id_monitoramento', '=', 'm.id')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('e.id', $value['idErro'])
                        ->get('e.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode alterar o monitoramento de erro a partir do token de outra aplicação.');
                    }
                }]
            ]
        ];
    }
}
