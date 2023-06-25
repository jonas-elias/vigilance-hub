<?php

namespace App\Api\V1\Usuario;

use App\Api\V1\Auth\Password;
use App\Api\V1\DB\Database;
use App\Api\V1\Usuario\Exception\UsuarioException;

/**
 * class UsuarioPersistence
 */
class UsuarioPersistence extends Database
{
    use Password;

    /**
     * Method to insert user in database
     *
     * @param array $inputs
     * @return int
     */
    public function insertGetId(array $inputs): int
    {
        try {
            return $this->getDb()->table('usuario')->insertGetId([
                'nome' => $inputs['nome'],
                'email' => $inputs['email'],
                'senha' => $this->hash($inputs['senha']),
                'data_criacao' => date('Y-m-d H:i:s')
            ]);
        } catch (\Throwable $th) {
            throw new UsuarioException(json_encode([
                'erros' => [
                    'Erro ao inserir usuário.'
                ]
            ]));
        }
    }

    /**
     * Method to update user in database
     *
     * @param array $inputs
     * @param int $userId
     */
    public function update(array $inputs, int $userId): void
    {
        try {
            $this->getDb()->table('usuario')
                ->where('id', '=', $userId)
                ->update([
                    'nome' => $inputs['nome'],
                    'email' => $inputs['email']
                ]);
        } catch (\Throwable $th) {
            throw new UsuarioException(json_encode([
                'erros' => [
                    'Erro ao fazer a alteração do usuário.'
                ]
            ]));
        }
    }
}
