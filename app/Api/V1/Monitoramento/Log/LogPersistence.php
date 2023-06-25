<?php

namespace App\Api\V1\Monitoramento\Log;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Log\Exception\LogException;

/**
 * class LogPersistence
 */
class LogPersistence extends Database
{
    /**
     * Method to insert log monitoramento in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('log')->insertGetId([
                'id_monitoramento' => $inputs['idMonitoramento'],
                'nivel' => $inputs['nivel'],
                'mensagem' => $inputs['mensagem']
            ]);
        } catch (\Throwable $th) {
            throw new LogException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento de log.'
                ]
            ]));
        }
    }

    /**
     * Method to update log monitoramento in database
     *
     * @param array $inputs
     * @param int $idLog
     * @return void
     */
    public function update(array $inputs, int $idLog): void
    {
        try {
            $this->getDb()->table('log')
                ->where('id', $idLog)
                ->update([
                    'nivel' => $inputs['nivel'],
                    'mensagem' => $inputs['mensagem']
                ]);
        } catch (\Throwable $th) {
            throw new LogException(json_encode([
                'erros' => [
                    'Erro ao alterar o monitoramento de log.'
                ]
            ]));
        }
    }
}
