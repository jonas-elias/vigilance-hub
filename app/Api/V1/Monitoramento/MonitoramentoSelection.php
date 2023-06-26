<?php

namespace App\Api\V1\Monitoramento;

use App\Api\V1\DB\Database;
use App\Api\V1\Monitoramento\Exception\MonitoramentoException;
use Hyperf\Collection\Collection;

/**
 * class MonitoramentoSelection
 */
class MonitoramentoSelection extends Database
{
    /**
     * Method to get total aplicacoes
     *
     * @return Collection
     */
    public function getTotalAplicacoes(): Collection
    {
        try {
            return $this->getDb()->table('cliente as c')
                ->selectRaw('c.id as id_cliente, u.nome, count(a.id) as aplicacoes')
                ->join('usuario as u', 'c.id_usuario', '=', 'u.id')
                ->join('aplicacao as a', 'c.id', '=', 'a.id_cliente')
                ->groupBy('c.id', 'u.nome')
                ->get();
        } catch (\Throwable $th) {
            throw new MonitoramentoException(json_encode([
                'erros' => [
                    'Erro ao recuperar o total de aplicações.'
                ]
            ]));
        }
    }

    /**
     * Method to getTotalMonitoramentos
     *
     * @param array $inputs
     * @return Collection
     */
    public function getTotalMonitoramentos(array $inputs): Collection
    {
        try {
            return $this->getDb()->table('cliente as c')
                ->selectRaw('
                    c.id as id_cliente, a.id as id_aplicacao, a.nome as nome_aplicacao,
                    count(ca.id) as cache, count(de.id) as depuracao, count(l.id) as log,
                    count(r.id) as request, count(e.id) as erro, count(q.id) as query')
                ->join('aplicacao as a', 'c.id', '=', 'a.id_cliente')
                ->join('monitoramento as m', 'a.id', '=', 'm.id_aplicacao')
                ->leftJoin('cache as ca', 'm.id', '=', 'ca.id_monitoramento')
                ->leftJoin('depuracao as de', 'm.id', '=', 'de.id_monitoramento')
                ->leftJoin('log as l', 'm.id', '=', 'l.id_monitoramento')
                ->leftJoin('request as r', 'm.id', '=', 'r.id_monitoramento')
                ->leftJoin('erro as e', 'm.id', '=', 'e.id_monitoramento')
                ->leftJoin('query as q', 'm.id', '=', 'q.id_monitoramento')
                ->groupBy('c.id', 'a.id', 'a.nome')
                ->where('c.token', $inputs['clienteToken'])
                ->where('a.token', $inputs['aplicacaoToken'])
                ->get();
        } catch (\Throwable $th) {
            throw new MonitoramentoException(json_encode([
                'erros' => [
                    'Erro ao recuperar os monitoramentos.'
                ]
            ]));
        }
    }

    /**
     * Method to getTotalMonitoramentoData
     *
     * @param array $inputs
     * @return Collection
     */
    public function getTotalMonitoramentoData(array $inputs): Collection
    {
        try {
            return $this->getDb()->table('cliente as c')
                ->selectRaw("
                    c.id as id_cliente, a.id as id_aplicacao, a.nome as nome_aplicacao,
                    to_char(m.data_criacao, 'dd/mm/yyyy') as data_monitoramento,
                    (count(ca.id) + count(de.id) + count(l.id) +
                    count(r.id) + count(e.id) + count(q.id)) as monitoramento_total"
                    )
                ->join('aplicacao as a', 'c.id', '=', 'a.id_cliente')
                ->join('monitoramento as m', 'a.id', '=', 'm.id_aplicacao')
                ->leftJoin('cache as ca', 'm.id', '=', 'ca.id_monitoramento')
                ->leftJoin('depuracao as de', 'm.id', '=', 'de.id_monitoramento')
                ->leftJoin('log as l', 'm.id', '=', 'l.id_monitoramento')
                ->leftJoin('request as r', 'm.id', '=', 'r.id_monitoramento')
                ->leftJoin('erro as e', 'm.id', '=', 'e.id_monitoramento')
                ->leftJoin('query as q', 'm.id', '=', 'q.id_monitoramento')
                ->groupBy('c.id', 'a.id', 'a.nome', 'data_monitoramento')
                ->where('c.token', $inputs['clienteToken'])
                ->where('a.token', $inputs['aplicacaoToken'])
                ->get();
        } catch (\Throwable $th) {
            throw new MonitoramentoException(json_encode([
                'erros' => [
                    'Erro ao recuperar o total de monitoramentos por data.'
                ]
            ]));
        }
    }
}
