<?php

namespace App\Api\V1\Validator;

use App\Api\V1\Validator\Contract\ValidatorInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * class Validator
 */
abstract class Validator implements ValidatorInterface
{
    /**
     * @var ValidatorFactoryInterface $validator
     */
    #[Inject]
    public ValidatorFactoryInterface $validator;

    /**
     * Abstract function sign in other classes
     *
     * @param array $inputs
     * @return void
     */
    abstract function validate(array $inputs): void;
}
