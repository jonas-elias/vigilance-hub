<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Monitoramento\Depuracao;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class DepuracaoController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }
}
