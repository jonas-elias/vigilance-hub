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
        Router::post('/usuario/register', 'App\Controller\Api\V1\Usuario\UsuarioController@register');
        Router::post('/aplicacao', 'App\Controller\Api\V1\Aplicacao\AplicacaoController@create');
        Router::post('/monitoramento/cache', 'App\Controller\Api\V1\Monitoramento\Cache\CacheController@create');
        Router::post('/monitoramento/depuracao', 'App\Controller\Api\V1\Monitoramento\Depuracao\DepuracaoController@create');
        Router::post('/monitoramento/erro', 'App\Controller\Api\V1\Monitoramento\Erro\ErroController@create');
        Router::post('/monitoramento/log', 'App\Controller\Api\V1\Monitoramento\Log\LogController@create');
        Router::post('/monitoramento/query', 'App\Controller\Api\V1\Monitoramento\Query\QueryController@create');
        Router::post('/monitoramento/request', 'App\Controller\Api\V1\Monitoramento\Request\RequestController@create');
    });
});
