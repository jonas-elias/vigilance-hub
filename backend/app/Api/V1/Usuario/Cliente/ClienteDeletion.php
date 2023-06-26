<?php

namespace App\Api\V1\Usuario\Cliente;

use App\Api\V1\DB\Database;
use App\Api\V1\Usuario\Cliente\Exception\ClienteException;
use App\Api\V1\Usuario\Exception\UsuarioException;
use App\Api\V1\Usuario\UsuarioDeletion;
use Hyperf\Di\Annotation\Inject;

/**
 * class ClienteDeletion
 */
class ClienteDeletion extends Database
{
    #[Inject]
    protected UsuarioDeletion $usuarioDeletion;

    /**
     * Method to delete cliente in database
     *
     * @param int $idCliente
     * @return void
     */
    public function delete(int $idCliente): void
    {
        try {
            $idUsuario = $this->getDb()->table('cliente')
                ->select('id_usuario')
                ->where('id', $idCliente)
                ->get()->first()['id_usuario'];
            $this->getDb()->table('cliente')
                ->where('id', $idCliente)
                ->delete();
            $this->usuarioDeletion->delete($idUsuario);
        } catch (UsuarioException $ue) {
            throw new ClienteException(json_encode([
                'erros' => [
                    'Erro ao deletar o cliente da tabela de usuários.'
                ]
            ]));
        } catch (\Throwable $th) {
            throw new ClienteException(json_encode([
                'erros' => [
                    'Erro ao deletar o cliente.'
                ]
            ]));
        }
    }
}
