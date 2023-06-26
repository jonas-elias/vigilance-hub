<?php

namespace App\Api\V1\Aplicacao;

use App\Api\V1\Aplicacao\Exception\AplicacaoException;
use App\Api\V1\DB\Database;

/**
 * class AplicacaoPersistence
 */
class AplicacaoPersistence extends Database
{
    use AplicacaoToken;

    /**
     * Method to insert application in database
     *
     * @param array $inputs
     * @return array
     */
    public function insert(array $inputs): array
    {
        try {
            $aplicacaoToken = $this->aplicacaoToken();
            $id = $this->getDb()->table('aplicacao')->insertGetId([
                'id_cliente' => $inputs['idCliente'],
                'token' => $aplicacaoToken,
                'data_criacao' => date('Y-m-d h:m:s'),
                'nome' => $inputs['nome']
            ]);
            return [
                'id' => $id,
                'applicationToken' => $aplicacaoToken
            ];
        } catch (\Throwable $th) {
            throw new AplicacaoException(json_encode([
                'erros' => [
                    'Erro ao inserir a aplicação.'
                ]
            ]));
        }
    }

    /**
     * Method to update application in database
     *
     * @param array $inputs
     * @param int $idAplicacao
     * @return void
     */
    public function update(array $inputs, int $idAplicacao): void
    {
        try {
            $this->getDb()->table('aplicacao')
                ->where('id', $idAplicacao)
                ->update([
                    'data_criacao' => date('Y-m-d h:m:s'),
                    'nome' => $inputs['nome']
                ]);
        } catch (\Throwable $th) {
            throw new AplicacaoException(json_encode([
                'erros' => [
                    'Erro ao alterar a aplicação.'
                ]
            ]));
        }
    }
}
