<?php

declare(strict_types=1);

namespace App\Controller\Api\V1\Database;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * class MigrationController
 */
class MigrationController
{
    /**
     * method to refresh migration
     *
     * @return void
     */
    public function index()
    {
        shell_exec('php bin/hyperf.php migrate:refresh');

        return [
            'success' => true
        ];
    }
}
