<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Request;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoPersistence;
use App\Api\V1\Monitoramento\Request\Exception\RequestException;
use App\Api\V1\Monitoramento\Request\RequestPersistence;
use App\Api\V1\Monitoramento\Request\Validation\RequestValidation;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class RequestController
 */
class RequestController
{
    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoPersistence $monitoramentoPersistence;

    #[Inject]
    protected RequestValidation $requestValidation;

    #[Inject]
    protected RequestPersistence $requestPersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to create request monitoramento
     */
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken')
        ];

        $inputsRequest = [
            'duracao' => $request->input('duracao'),
            'status' => $request->input('status'),
            'metodo' => $request->input('metodo'),
            'uri' => $request->input('uri'),
            'headers' => $request->input('headers'),
            'response' => $request->input('response')
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento, 'insert');
            $this->transaction->beginTransaction();
            $id = $this->monitoramentoPersistence->insertGetId($inputsMonitoramento);
            $inputsRequest = array_merge($inputsRequest, ['idMonitoramento' => $id]);
            $this->requestValidation->validate($inputsRequest, 'insert');
            $this->requestPersistence->insertGetId($inputsRequest);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento da request criado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (RequestException $de) {
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
     * Method to update request monitoramento
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idRequest
     */
    public function update(RequestInterface $request, ResponseInterface $response, int $idRequest)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken')
        ];

        $inputsRequest = [
            'duracao' => $request->input('duracao'),
            'status' => $request->input('status'),
            'metodo' => $request->input('metodo'),
            'uri' => $request->input('uri'),
            'headers' => $request->input('headers'),
            'response' => $request->input('response'),
            'idRequest' => $idRequest
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento, 'update');
            $this->requestValidation->validate($inputsRequest, 'update');
            $this->transaction->beginTransaction();
            $this->requestPersistence->update($inputsRequest, $inputsRequest['idRequest']);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento da request alterado com sucesso.'
            ])->withStatus(200);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (RequestException $de) {
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
