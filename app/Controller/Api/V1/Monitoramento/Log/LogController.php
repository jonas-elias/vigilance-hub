<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Log;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\Log\Exception\LogException;
use App\Api\V1\Monitoramento\Log\LogPersistence;
use App\Api\V1\Monitoramento\Log\Validation\LogValidation;
use App\Api\V1\Monitoramento\MonitoramentoPersistence;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class LogController
 */
class LogController
{
    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoPersistence $monitoramentoPersistence;

    #[Inject]
    protected LogValidation $logValidation;

    #[Inject]
    protected LogPersistence $logPersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to create log monitoramento
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

        $inputsLog = [
            'nivel' => $request->input('nivel'),
            'mensagem' => $request->input('mensagem')
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento, 'insert');
            $this->transaction->beginTransaction();
            $id = $this->monitoramentoPersistence->insertGetId($inputsMonitoramento);
            $inputsLog = array_merge($inputsLog, ['idMonitoramento' => $id]);
            $this->logValidation->validate($inputsLog, 'insert');
            $this->logPersistence->insertGetId($inputsLog);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de log criado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (LogException $de) {
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
     * Method to create log monitoramento
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param int $idLog
     */
    public function update(RequestInterface $request, ResponseInterface $response, int $idLog)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken')
        ];

        $inputsLog = [
            'nivel' => $request->input('nivel'),
            'mensagem' => $request->input('mensagem'),
            'idLog' => $idLog
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento, 'update');
            $this->logValidation->validate($inputsLog, 'update');
            $this->transaction->beginTransaction();
            $this->logPersistence->update($inputsLog, $inputsLog['idLog']);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de log alterado com sucesso.'
            ])->withStatus(200);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (LogException $de) {
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
