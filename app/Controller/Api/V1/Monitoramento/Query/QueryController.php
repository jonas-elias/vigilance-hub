<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Query;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoPersistence;
use App\Api\V1\Monitoramento\Query\Exception\QueryException;
use App\Api\V1\Monitoramento\Query\QueryPersistence;
use App\Api\V1\Monitoramento\Query\Validation\QueryValidation;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class QueryController
 */
class QueryController
{
    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoPersistence $monitoramentoPersistence;

    #[Inject]
    protected QueryValidation $queryValidation;

    #[Inject]
    protected QueryPersistence $queryPersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to create query monitoramento
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken')
        ];

        $inputsQuery = [
            'duracao' => $request->input('duracao'),
            'conector' => $request->input('conector'),
            'localizacao' => $request->input('localizacao'),
            'query' => $request->input('query')
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento, 'insert');
            $this->transaction->beginTransaction();
            $id = $this->monitoramentoPersistence->insertGetId($inputsMonitoramento);
            $inputsQuery = array_merge($inputsQuery, ['idMonitoramento' => $id]);
            $this->queryValidation->validate($inputsQuery, 'insert');
            $this->queryPersistence->insertGetId($inputsQuery);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de query criado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (QueryException $de) {
            $this->transaction->rollBack();
            return $response->json(json_decode($de->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'errors' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }

    /**
     * Method to update query monitoramento
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idQuery
     */
    public function update(RequestInterface $request, ResponseInterface $response, int $idQuery)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken')
        ];

        $inputsQuery = [
            'duracao' => $request->input('duracao'),
            'conector' => $request->input('conector'),
            'localizacao' => $request->input('localizacao'),
            'query' => $request->input('query'),
            'idQuery' => $idQuery
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento, 'update');
            $this->queryValidation->validate($inputsQuery, 'update');
            $this->transaction->beginTransaction();
            $this->queryPersistence->update($inputsQuery, $inputsQuery['idQuery']);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de query alterado com sucesso.'
            ])->withStatus(200);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (QueryException $de) {
            $this->transaction->rollBack();
            return $response->json(json_decode($de->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'errors' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
