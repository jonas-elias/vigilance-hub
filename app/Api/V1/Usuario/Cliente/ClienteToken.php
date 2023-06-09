<?php

namespace App\Api\V1\Usuario\Cliente;

/**
 * trait ClienteToken
 */
trait ClienteToken
{
    private int $numBytes = 10;

    /**
     * Method to return hash cliente token
     *
     * @return string
     */
    public function clienteToken(): string
    {
        return hash('sha512', random_bytes($this->numBytes));
    }
}
