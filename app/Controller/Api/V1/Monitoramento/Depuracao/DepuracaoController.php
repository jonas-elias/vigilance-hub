<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Depuracao;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Depuracao\DepuracaoPersistence;
use App\Api\V1\Monitoramento\Depuracao\Exception\DepuracaoException;
use App\Api\V1\Monitoramento\Depuracao\Validation\DepuracaoValidation;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoPersistence;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class DepuracaoController 
 */
class DepuracaoController
{
    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoPersistence $monitoramentoPersistence;

    #[Inject]
    protected DepuracaoValidation $depuracaoValidation;

    #[Inject]
    protected DepuracaoPersistence $depuracaoPersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to create depuracao
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

        $inputsDepuracao = [
            'depuracao' => $request->input('depuracao')
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento);
            $this->transaction->beginTransaction();
            $id = $this->monitoramentoPersistence->insertGetId($inputsMonitoramento);
            $inputsDepuracao = array_merge($inputsDepuracao, ['idMonitoramento' => $id]);
            $this->depuracaoValidation->validate($inputsDepuracao);
            $this->depuracaoPersistence->insertGetId($inputsDepuracao);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de depuração criado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (DepuracaoException $de) {
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
