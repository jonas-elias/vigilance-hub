<?php

namespace App\Api\V1\Usuario\Cliente;

use App\Api\V1\DB\Database;
use App\Api\V1\Usuario\Cliente\Exception\ClienteException;

/**
 * class ClientePersistence
 */
class ClientePersistence extends Database
{
    use ClienteToken;

    /**
     * Method to insert cliente usuario
     *
     * @param int $userId
     * @return string
     */
    public function insert(int $userId): string
    {
        try {
            $token = $this->clienteToken();
            $this->getDb()->table('cliente')->insert([
                'id_usuario' => $userId,
                'token' => $token
            ]);
            return $token;
        } catch (\Throwable $th) {
            throw new ClienteException(json_encode([
                'erros' => [
                    'Erro ao inserir usuário do tipo cliente.'
                ]
            ]));
        }
    }
}
