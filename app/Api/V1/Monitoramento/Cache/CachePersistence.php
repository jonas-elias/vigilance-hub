<?php

namespace App\Api\V1\Monitoramento\Cache;

use App\Api\V1\Monitoramento\Cache\Exception\CacheException;
use App\Api\V1\DB\Database;

/**
 * class CachePersistence
 */
class CachePersistence extends Database
{
    /**
     * Method to insert cache monitoramento in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('cache')->insertGetId([
                'id_monitoramento' => $inputs['idMonitoramento'],
                'chave' => $inputs['chave'],
                'acao' => $inputs['acao']
            ]);
        } catch (\Throwable $th) {
            throw new CacheException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento de cache.'
                ]
            ]));
        }
    }

    /**
     * Method to update cache monitoramento in database
     *
     * @param array $inputs
     * @param int $cacheId
     * @return void
     */
    public function update(array $inputs, int $cacheId): void
    {
        try {
            $this->getDb()->table('cache')
                ->where('id', '=', $cacheId)
                ->update([
                    'chave' => $inputs['chave'],
                    'acao' => $inputs['acao']
                ]);
        } catch (\Throwable $th) {
            throw new CacheException(json_encode([
                'erros' => [
                    'Erro ao fazer a alteração do monitoramento de cache.'
                ]
            ]));
        }
    }
}
