<?php

namespace App\Api\V1\Monitoramento\Request\Validation;

use App\Api\V1\Validator\Validator;
use Hyperf\DbConnection\Db;

/**
 * class RequestValidation
 */
class RequestValidation extends Validator
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
            'status' => $inputs['status'] ?? '',
            'metodo' => $inputs['metodo'] ?? '',
            'uri' => $inputs['uri'] ?? '',
            'headers' => $inputs['headers'] ?? '',
            'response' => $inputs['response'] ?? '',
            'idRequest' => $inputs['idRequest'] ?? '',
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
                'status' => 'required|integer',
                'metodo' => 'required|string|max:7',
                'uri' => 'required|string|max:255',
                'headers' => 'required|string|max:8192',
                'response' => 'required|string|max:8192'
            ],
            'update' => [
                'idRequest' => 'required|integer|exists:request,id',
                'duracao' => 'required|numeric',
                'status' => 'required|integer',
                'metodo' => 'required|string|max:7',
                'uri' => 'required|string|max:255',
                'headers' => 'required|string|max:8192',
                'response' => 'required|string|max:8192',
                'credenciais' => [function ($attribute, $value, $fail) {
                    if (!(Db::table('request as r')
                        ->join('monitoramento as m', 'r.id_monitoramento', '=', 'm.id')
                        ->join('aplicacao as a', 'm.id_aplicacao', '=', 'a.id')
                        ->join('cliente as cli', 'a.id_cliente', '=', 'cli.id')
                        ->where('cli.token', $value['clienteToken'])
                        ->where('a.token', $value['aplicacaoToken'])
                        ->where('r.id', $value['idRequest'])
                        ->get('r.id')
                        ->first()['id'] ?? null)) {
                        $fail('O cliente não pode alterar o monitoramento de request a partir do token de outra aplicação.');
                    }
                }]
            ]
        ];
    }
}
