<?php

namespace App\Api\V1\DB\Transaction;

use App\Api\V1\DB\Database;

class Transaction extends Database
{
    /**
     * Method to init transaction
     *
     * @return void
     */
    public function beginTransaction(): void
    {
        $this->getDb()->beginTransaction();
    }

    /**
     * Method to commit transaction
     *
     * @return void
     */
    public function commit(): void
    {
        $this->getDb()->commit();
    }

    /**
     * Method to rollback transaction
     *
     * @return void
     */
    public function rollBack(): void
    {
        $this->getDb()->rollBack();
    }
}
