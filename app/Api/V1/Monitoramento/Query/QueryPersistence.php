<?php

namespace App\Api\V1\Monitoramento\Query;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Query\Exception\QueryException;

/**
 * class QueryPersistence
 */
class QueryPersistence extends Database
{
    /**
     * Method to insert query monitoramento in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('query')->insertGetId([
                'id_monitoramento' => $inputs['idMonitoramento'],
                'duracao' => $inputs['duracao'],
                'conector' => $inputs['conector'],
                'localizacao' => $inputs['localizacao'],
                'query' => $inputs['query']
            ]);
        } catch (\Throwable $th) {
            throw new QueryException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento de query.'
                ]
            ]));
        }
    }

    /**
     * Method to update query monitoramento in database
     *
     * @param array $inputs
     * @param int $idQuery
     * @return void
     */
    public function update(array $inputs, int $idQuery): void
    {
        try {
            $this->getDb()->table('query')
            ->where('id', $idQuery)
            ->update([
                'duracao' => $inputs['duracao'],
                'conector' => $inputs['conector'],
                'localizacao' => $inputs['localizacao'],
                'query' => $inputs['query']
            ]);
        } catch (\Throwable $th) {
            throw new QueryException(json_encode([
                'erros' => [
                    'Erro ao alterar o monitoramento de query.'
                ]
            ]));
        }
    }
}
