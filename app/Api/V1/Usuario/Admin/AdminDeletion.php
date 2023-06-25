<?php

namespace App\Api\V1\Usuario\Admin;

use App\Api\V1\DB\Database;
use App\Api\V1\Usuario\Admin\Exception\AdminException;
use App\Api\V1\Usuario\Exception\UsuarioException;
use App\Api\V1\Usuario\UsuarioDeletion;
use Hyperf\Di\Annotation\Inject;

/**
 * class AdminDeletion
 */
class AdminDeletion extends Database
{
    #[Inject]
    protected UsuarioDeletion $usuarioDeletion;

    /**
     * Method to delete user in database
     *
     * @param int $userId
     * @return void
     */
    public function delete(int $idAdmin): void
    {
        try {
            $idUsuario = $this->getDb()->table('admin')
                ->select('id_usuario')
                ->where('id', $idAdmin)
                ->get()->first()['id_usuario'];
            $this->getDb()->table('admin')
                ->where('id', $idAdmin)
                ->delete();
            $this->usuarioDeletion->delete($idUsuario);
        } catch (UsuarioException $ue) {
            throw new AdminException(json_encode([
                'erros' => [
                    'Erro ao deletar o admin da tabela de usuários.'
                ]
            ]));
        } catch (\Throwable $th) {
            throw new AdminException(json_encode([
                'erros' => [
                    'Erro ao deletar o admin.'
                ]
            ]));
        }
    }
}
