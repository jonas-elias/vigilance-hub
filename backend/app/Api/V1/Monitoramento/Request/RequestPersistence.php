<?php

namespace App\Api\V1\Monitoramento\Request;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Request\Exception\RequestException;

/**
 * class RequestPersistence
 */
class RequestPersistence extends Database
{
    /**
     * Method to insert request monitoramento in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('request')->insertGetId([
                'id_monitoramento' => $inputs['idMonitoramento'],
                'duracao' => $inputs['duracao'],
                'status' => $inputs['status'],
                'metodo' => $inputs['metodo'],
                'uri' => $inputs['uri'],
                'headers' => $inputs['headers'],
                'response' => $inputs['response']
            ]);
        } catch (\Throwable $th) {
            throw new RequestException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento da request.'
                ]
            ]));
        }
    }

    /**
     * Method to insert request monitoramento in database
     *
     * @param array $inputs
     * @param int $idRequest
     * @return void
     */
    public function update(array $inputs, int $idRequest): int
    {
        try {
            return $this->getDb()->table('request')
                ->where('id', $idRequest)
                ->update([
                    'duracao' => $inputs['duracao'],
                    'status' => $inputs['status'],
                    'metodo' => $inputs['metodo'],
                    'uri' => $inputs['uri'],
                    'headers' => $inputs['headers'],
                    'response' => $inputs['response']
                ]);
        } catch (\Throwable $th) {
            throw new RequestException(json_encode([
                'erros' => [
                    'Erro ao alterar o monitoramento da request.'
                ]
            ]));
        }
    }
}
