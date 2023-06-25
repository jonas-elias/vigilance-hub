<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

Router::addGroup('/api', function () {
    Router::addGroup('/v1', function () {
        Router::addGroup('/usuario', function () {
            Router::put('/update/{userId}', 'App\Controller\Api\V1\Usuario\UsuarioController@update');
            Router::post('/register', 'App\Controller\Api\V1\Usuario\UsuarioController@register');
            Router::delete('/cliente/{idCliente}', 'App\Controller\Api\V1\Usuario\Cliente\ClienteController@delete');
            Router::delete('/admin/{idAdmin}', 'App\Controller\Api\V1\Usuario\Admin\AdminController@delete');
        });
        Router::addGroup('/aplicacao', function () {
            Router::post('', 'App\Controller\Api\V1\Aplicacao\AplicacaoController@create');
            Router::put('/{idAplicacao}', 'App\Controller\Api\V1\Aplicacao\AplicacaoController@update');
            Router::delete('/{idAplicacao}', 'App\Controller\Api\V1\Aplicacao\AplicacaoController@delete');
        });

        Router::addGroup('/monitoramento', function () {
            Router::delete('/{idMonitoramento}', 'App\Controller\Api\V1\Monitoramento\MonitoramentoController@delete');
            Router::post('/cache', 'App\Controller\Api\V1\Monitoramento\Cache\CacheController@create');
            Router::put('/cache/{idCache}', 'App\Controller\Api\V1\Monitoramento\Cache\CacheController@update');
            Router::post('/depuracao', 'App\Controller\Api\V1\Monitoramento\Depuracao\DepuracaoController@create');
            Router::put('/depuracao/{idDepuracao}', 'App\Controller\Api\V1\Monitoramento\Depuracao\DepuracaoController@update');
            Router::post('/erro', 'App\Controller\Api\V1\Monitoramento\Erro\ErroController@create');
            Router::put('/erro/{idErro}', 'App\Controller\Api\V1\Monitoramento\Erro\ErroController@update');
            Router::post('/log', 'App\Controller\Api\V1\Monitoramento\Log\LogController@create');
            Router::put('/log/{idLog}', 'App\Controller\Api\V1\Monitoramento\Log\LogController@update');
            Router::post('/query', 'App\Controller\Api\V1\Monitoramento\Query\QueryController@create');
            Router::put('/query/{idQuery}', 'App\Controller\Api\V1\Monitoramento\Query\QueryController@update');
            Router::post('/request', 'App\Controller\Api\V1\Monitoramento\Request\RequestController@create');
            Router::put('/request/{idRequest}', 'App\Controller\Api\V1\Monitoramento\Request\RequestController@update');
        });
    });
});
