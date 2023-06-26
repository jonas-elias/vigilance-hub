<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoDeletion;
use App\Api\V1\Monitoramento\MonitoramentoSelection;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class MonitoramentoController
 */
class MonitoramentoController
{
    #[Inject]
    protected Transaction $transaction;

    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoDeletion $monitoramentoDeletion;

    #[Inject]
    protected MonitoramentoSelection $monitoramentoSelection;

    /**
     * Method to get total aplicações
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function getTotalAplicacoes(RequestInterface $request, ResponseInterface $response)
    {
        try {
            return $response->json([
                'success' => true,
                'response' => $this->monitoramentoSelection->getTotalAplicacoes()
            ])->withStatus(200);
        } catch (\InvalidArgumentException $in) {
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }

    /**
     * Method to get total monitoramentos
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function getTotalMonitoramentos(RequestInterface $request, ResponseInterface $response)
    {
        $inputsMonitoramento = [
            'clienteToken' => $request->header('clienteToken'),
            'aplicacaoToken' => $request->header('aplicacaoToken')
        ];

        try {
            $this->monitoramentoValidation->validate(
                array_merge($inputsMonitoramento, ['credenciais' => $inputsMonitoramento]),
                'getTotalMonitoramentos'
            );

            return $response->json([
                'success' => true,
                'response' => $this->monitoramentoSelection->getTotalMonitoramentos($inputsMonitoramento)
            ])->withStatus(200);
        } catch (\InvalidArgumentException $in) {
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }

     /**
     * Method to get total monitoramento por data
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function getTotalMonitoramentoData(RequestInterface $request, ResponseInterface $response)
    {
        $inputsMonitoramento = [
            'clienteToken' => $request->header('clienteToken'),
            'aplicacaoToken' => $request->header('aplicacaoToken')
        ];

        try {
            $this->monitoramentoValidation->validate(
                array_merge($inputsMonitoramento, ['credenciais' => $inputsMonitoramento]),
                'getTotalMonitoramentoData'
            );

            return $response->json([
                'success' => true,
                'response' => $this->monitoramentoSelection->getTotalMonitoramentoData($inputsMonitoramento)
            ])->withStatus(200);
        } catch (\InvalidArgumentException $in) {
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }

    /**
     * Method to delete monitoramento
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idMonitoramento
     */
    public function delete(RequestInterface $request, ResponseInterface $response, int $idMonitoramento)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken'),
            'idMonitoramento' => $idMonitoramento
        ];

        try {
            $this->monitoramentoValidation->validate(array_merge($inputsMonitoramento, ['credenciais' => [
                'aplicacaoToken' => $request->header('aplicacaoToken'),
                'clienteToken' => $request->header('clienteToken'),
                'idMonitoramento' => $inputsMonitoramento['idMonitoramento']
            ]]), 'delete');
            $this->transaction->beginTransaction();
            $this->monitoramentoDeletion->delete($idMonitoramento);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento excluído com sucesso.'
            ])->withStatus(200);
        } catch (\InvalidArgumentException $in) {
            $this->transaction->rollBack();
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
