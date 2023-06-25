<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Usuario\Admin;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Usuario\Admin\AdminDeletion;
use App\Api\V1\Usuario\Admin\Exception\AdminException;
use App\Api\V1\Usuario\Admin\Validation\AdminValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class AdminController
 */
class AdminController
{
    #[Inject]
    protected AdminValidation $adminValidation;

    #[Inject]
    protected AdminDeletion $adminDeletion;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to delete admin
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idAdmin
     */
    public function delete(RequestInterface $request, ResponseInterface $response, int $idAdmin)
    {
        try {
            $this->adminValidation->validate(['idAdmin' => $idAdmin], 'delete');
            $this->transaction->beginTransaction();
            $this->adminDeletion->delete($idAdmin);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Admin excluído com sucesso.'
            ])->withStatus(200);
        } catch (\InvalidArgumentException $in) {
            $this->transaction->rollBack();
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (AdminException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
