<?php

namespace App\Api\V1\Auth;

/**
 * trait Password
 */
trait Password
{
    /**
     * Method to hash password
     *
     * @return string $senha
     */
    public function hash(string $senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }
}
