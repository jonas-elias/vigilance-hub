<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoDeletion;
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

    /**
     * Method to delete monitoramento
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idMonitoramento
     */
    public function delete(RequestInterface $request, ResponseInterface $response, int $idMonitoramento)
    {
        try {
            $this->monitoramentoValidation->validate(['idMonitoramento' => $idMonitoramento], 'delete');
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
            dd($th->getMessage());
            return $response->json(([
                'errors' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
