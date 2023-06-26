<?php

namespace App\Api\V1\Monitoramento;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;

/**
 * class MonitoramentoPersistence
 */
class MonitoramentoPersistence extends Database
{
    /**
     * Method to insert application in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('monitoramento')->insertGetId([
                'id_aplicacao' => $this->getDb()->table('aplicacao as a')
                    ->join('cliente as c', 'a.id_cliente', '=', 'c.id')
                    ->select('a.id')
                    ->where('c.token', $inputs['clienteToken'])
                    ->where('a.token', $inputs['aplicacaoToken'])
                    ->first()['id'],
                'data_criacao' => date('Y-m-d H:m:s')
            ]);
        } catch (\Throwable $th) {
            throw new MonitoramentoException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento.'
                ]
            ]));
        }
    }
}
