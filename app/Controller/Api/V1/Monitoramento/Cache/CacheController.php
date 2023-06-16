<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Cache;

use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Monitoramento\Cache\CachePersistence;
use App\Api\V1\Monitoramento\Cache\Exception\CacheException;
use App\Api\V1\Monitoramento\Cache\Validation\CacheValidation;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use App\Api\V1\Monitoramento\MonitoramentoPersistence;
use App\Api\V1\Monitoramento\Validation\MonitoramentoValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class CacheController 
 */
class CacheController
{
    #[Inject]
    protected MonitoramentoValidation $monitoramentoValidation;

    #[Inject]
    protected MonitoramentoPersistence $monitoramentoPersistence;

    #[Inject]
    protected CacheValidation $cacheValidation;

    #[Inject]
    protected CachePersistence $cachePersistence;

    #[Inject]
    protected Transaction $transaction;

    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $inputsMonitoramento = [
            'aplicacaoToken' => $request->header('aplicacaoToken'),
            'clienteToken' => $request->header('clienteToken')
        ];

        $inputsCache = [
            'chave' => $request->input('chave'),
            'acao' => $request->input('acao')
        ];

        try {
            $this->monitoramentoValidation->validate($inputsMonitoramento);
            $this->transaction->beginTransaction();
            $id = $this->monitoramentoPersistence->insertGetId($inputsMonitoramento);
            $inputsCache = array_merge($inputsCache, ['idMonitoramento' => $id]);
            $this->cacheValidation->validate($inputsCache);
            $this->cachePersistence->insertGetId($inputsCache);
            $this->transaction->commit();
            return $response->json([
                'success' => true,
                'message' => 'Monitoramento de cache criado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $in) {
            $this->transaction->rollBack();
            return $response->json(json_decode($in->getMessage()))->withStatus(400);
        } catch (CacheException $ae) {
            return $response->json(json_decode($ae->getMessage()))->withStatus(400);
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
