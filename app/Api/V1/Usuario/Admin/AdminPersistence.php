<?php

namespace App\Api\V1\Usuario\Admin;

use App\Api\V1\DB\Database;
use App\Api\V1\Usuario\Admin\Exception\AdminException;

/**
 * class AdminPersistence
 */
class AdminPersistence extends Database
{
    /**
     * Method to insert admin user
     *
     * @param int $userId
     * @return void
     */
    public function insert(int $userId)
    {
        try {
            $this->getDb()->table('admin')->insert([
                'id_usuario' => $userId
            ]);
        } catch (\Throwable $th) {
            throw new AdminException(json_encode([
                'erros' => [
                    'Erro ao inserir usuário do tipo admin.'
                ]
            ]));
        }
    }
}
