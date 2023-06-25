<?php

namespace App\Api\V1\Monitoramento\Erro;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Erro\Exception\ErroException;

/**
 * class ErroPersistence
 */
class ErroPersistence extends Database
{
    /**
     * Method to insert erro monitoramento in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('erro')->insertGetId([
                'id_monitoramento' => $inputs['idMonitoramento'],
                'nivel' => $inputs['nivel'],
                'localizacao' => $inputs['localizacao'],
                'stacktrace' => $inputs['stacktrace']
            ]);
        } catch (\Throwable $th) {
            throw new ErroException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento de erro.'
                ]
            ]));
        }
    }

    /**
     * Method to update erro monitoramento in database
     *
     * @param array $inputs
     * @param int $idErro
     * @return void
     */
    public function update(array $inputs, int $idErro): void
    {
        try {
            $this->getDb()->table('erro')
            ->where('id', $idErro)
            ->update([
                'nivel' => $inputs['nivel'],
                'localizacao' => $inputs['localizacao'],
                'stacktrace' => $inputs['stacktrace']
            ]);
        } catch (\Throwable $th) {
            throw new ErroException(json_encode([
                'erros' => [
                    'Erro ao alterar o monitoramento de erro.'
                ]
            ]));
        }
    }
}
