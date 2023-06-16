<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Aplicacao;

use App\Api\V1\Aplicacao\AplicacaoPersistence;
use App\Api\V1\Aplicacao\Exception\AplicacaoException;
use App\Api\V1\Aplicacao\Validation\AplicacaoValidation;
use App\Api\V1\DB\Transaction\Transaction;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class AplicacaoController
 */
class AplicacaoController
{
    #[Inject]
    protected AplicacaoValidation $aplicacaoValidation;

    #[Inject]
    protected AplicacaoPersistence $aplicacaoPersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to create new application
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $inputs = [
            'idCliente' => $request->input('idCliente'),
            'nome' => $request->input('nome')
        ];

        try {
            $this->aplicacaoValidation->validate($inputs);
            $this->transaction->beginTransaction();
            $this->aplicacaoPersistence->insertGetId($inputs);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Aplicação inserida com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $in) {
            $this->transaction->rollBack();
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (AplicacaoException $ae) {
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'errors' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
