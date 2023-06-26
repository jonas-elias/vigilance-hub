<?php

namespace App\Api\V1\Aplicacao;

use App\Api\V1\Aplicacao\Exception\AplicacaoException;
use App\Api\V1\DB\Database;

/**
 * class AplicacaoPersistence
 */
class AplicacaoDeletion extends Database
{
    /**
     * Method to delete application in database
     *
     * @param int $idAplicacao
     * @return void
     */
    public function delete(int $idAplicacao): void
    {
        try {
            $this->getDb()->table('aplicacao as a')
                ->join('monitoramento as m', 'a.id', '=', 'm.id_aplicacao')
                ->where('a.id', $idAplicacao)
                ->delete();
        } catch (\Throwable $th) {
            throw new AplicacaoException(json_encode([
                'erros' => [
                    'Erro ao deletar a aplicação.'
                ]
            ]));
        }
    }
}
