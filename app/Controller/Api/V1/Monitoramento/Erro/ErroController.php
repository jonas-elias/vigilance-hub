<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Erro;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Erro\ErroPersistence;
use App\Api\V1\Monitoramento\Erro\Exception\ErroException;
use App\Api\V1\Monitoramento\Erro\Validation\ErroValidation;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoPersistence;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class ErroController
{
    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoPersistence $monitoramentoPersistence;

    #[Inject]
    protected ErroValidation $erroValidation;

    #[Inject]
    protected ErroPersistence $erroPersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method to create erro monitoramento
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

        $inputsErro = [
            'nivel' => $request->input('nivel'),
            'localizacao' => $request->input('localizacao'),
            'stacktrace' => $request->input('stacktrace')
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento);
            $this->transaction->beginTransaction();
            $id = $this->monitoramentoPersistence->insertGetId($inputsMonitoramento);
            $inputsErro = array_merge($inputsErro, ['idMonitoramento' => $id]);
            $this->erroValidation->validate($inputsErro);
            $this->erroPersistence->insertGetId($inputsErro);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de erro criado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $ie) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ie->getMessage()))->withStatus(400);
        } catch (MonitoramentoException $ae) {
            $this->transaction->rollBack();
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
        } catch (ErroException $de) {
            $this->transaction->rollBack();
            return $response->json(json_decode($de->getMessage()))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            dd($th->getMessage());
            return $response->json(([
                'errors' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
