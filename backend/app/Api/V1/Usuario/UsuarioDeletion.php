<?php

namespace App\Api\V1\Usuario;

use App\Api\V1\DB\Database;
use App\Api\V1\Usuario\Exception\UsuarioException;

/**
 * class UsuarioDeletion
 */
class UsuarioDeletion extends Database
{
    /**
     * Method to delete user in database
     *
     * @param int $userId
     * @return void
     */
    public function delete(int $userId): void
    {
        try {
            $this->getDb()->table('usuario')
                ->where('id', '=', $userId)
                ->delete();
        } catch (\Throwable $th) {
            throw new UsuarioException(json_encode([
                'erros' => [
                    'Erro ao deletar o usuário.'
                ]
            ]));
        }
    }
}
