<?php

namespace App\Controller\Api\V1\Usuario;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class UsuarioController
 */
class UsuarioController
{
    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Method to insert new user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array 
     */
    public function register(RequestInterface $request, ResponseInterface $response)
    {
        try {
            $params = [
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'senha' => $request->input('senha'),
                'isAdmin' => $request->input('isAdmin')
            ];
            return $params;
        } catch (\Throwable $th) {
        }
    }
}
