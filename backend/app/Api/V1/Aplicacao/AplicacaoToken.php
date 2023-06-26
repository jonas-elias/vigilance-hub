<?php

namespace App\Api\V1\Aplicacao;

/**
 * trait AplicacaoToken
 */
trait AplicacaoToken
{
    private int $numBytes = 10;

    /**
     * Method to return hash cliente token
     *
     * @return string
     */
    public function aplicacaoToken(): string
    {
        return hash('sha512', random_bytes($this->numBytes));
    }
}
