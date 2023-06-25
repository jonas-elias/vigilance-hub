<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Usuario\Cliente;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Usuario\Cliente\ClienteDeletion;
use App\Api\V1\Usuario\Cliente\Exception\ClienteException;
use App\Api\V1\Usuario\Cliente\Validation\ClienteValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class ClienteController
 */
class ClienteController
{
    #[Inject]
    protected ClienteValidation $clienteValidation;

    #[Inject]
    protected ClienteDeletion $clienteDeletion;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to delete cliente
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idCliente
     */
    public function delete(RequestInterface $request, ResponseInterface $response, int $idCliente)
    {
        try {
            $this->clienteValidation->validate(['idCliente' => $idCliente], 'delete');
            $this->transaction->beginTransaction();
            $this->clienteDeletion->delete($idCliente);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Cliente excluído com sucesso.'
            ])->withStatus(200);
        } catch (\InvalidArgumentException $in) {
            $this->transaction->rollBack();
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (ClienteException $ae) {
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
