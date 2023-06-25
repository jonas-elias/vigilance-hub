<?php

namespace App\Api\V1\Monitoramento\Depuracao;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Depuracao\Exception\DepuracaoException;

/**
 * class DepuracaoPersistence
 */
class DepuracaoPersistence extends Database
{
    /**
     * Method to insert depuracao monitoramento in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('depuracao')->insertGetId([
                'id_monitoramento' => $inputs['idMonitoramento'],
                'depuracao' => $inputs['depuracao']
            ]);
        } catch (\Throwable $th) {
            throw new DepuracaoException(json_encode([
                'erros' => [
                    'Erro ao inserir o monitoramento de depuração.'
                ]
            ]));
        }
    }

    /**
     * Method to update depuracao monitoramento in database
     *
     * @param array $inputs
     * @param int $idDepuracao
     * @return void
     */
    public function update(array $inputs, int $idDepuracao): void
    {
        try {
            $this->getDb()->table('depuracao')
                ->where('id', '=', $idDepuracao)
                ->update([
                    'depuracao' => $inputs['depuracao'],
                ]);
        } catch (\Throwable $th) {
            throw new DepuracaoException(json_encode([
                'erros' => [
                    'Erro ao alterar o monitoramento de depuração.'
                ]
            ]));
        }
    }
}
