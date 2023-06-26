<?php

namespace App\Api\V1\Validator\Contract;

/**
 * interface ValidatorInterface
 */
interface ValidatorInterface
{
    /**
     * Method with rules of the class
     *
     * @return array
     */
    public function rules(): array;
}
