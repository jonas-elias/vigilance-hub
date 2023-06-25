<?php

namespace App\Api\V1\Monitoramento\Depuracao\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class DepuracaoValidation
 */
class DepuracaoValidation extends Validator
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
            'depuracao' => $inputs['depuracao'] ?? '',
            'idDepuracao' => $inputs['idDepuracao'] ?? '',
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
                'idMonitoramento' => 'required|integer|exists:monitoramento,id',
                'depuracao' => 'required|string|max:4096',
            ],
            'update' => [
                'depuracao' => 'required|string|max:4096',
                'idDepuracao' => 'required|integer|exists:depuracao,id',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('depuracao as d')
                        ->join('monitoramento as m', 'd.id_monitoramento', '=', 'm.id')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('d.id', $value['idDepuracao'])
                        ->get('d.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode alterar o monitoramento de depuração a partir do token de outra aplicação.');
                    }
                }]
            ]
        ];
    }
}
