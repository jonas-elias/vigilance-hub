<?php

namespace App\Api\V1\Monitoramento;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;

/**
 * class MonitoramentoDeletion
 */
class MonitoramentoDeletion extends Database
{
    /**
     * Method to delete monitoramento in database
     *
     * @param int $idMonitoramento
     * @return void
     */
    public function delete(int $idMonitoramento): void
    {
        try {
            $this->getDb()->table('monitoramento')
                ->where('id', $idMonitoramento)
                ->delete();
        } catch (\Throwable $th) {
            throw new MonitoramentoException(json_encode([
                'erros' => [
                    'Erro ao deletar o monitoramento.'
                ]
            ]));
        }
    }
}
