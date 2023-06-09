<?php

namespace App\Api\V1\DB;

use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

/**
 * class Database
 */
class Database
{
    /**
     * @var Db $db
     */
    #[Inject]
    protected Db $db;

    /**
     * Method to get db connection
     */
    public function getDb()
    {
        return $this->db;
    }
}
