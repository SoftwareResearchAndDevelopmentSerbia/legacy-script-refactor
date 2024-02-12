<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Db;

use Model\Db\Connection as DbConnection;

class ConnectionPool
{
    /**
     * @var array
     */
    private array $availableConnections = [];

    /**
     * @var array
     */
    private array $inUseConnections = [];

    /**
     * @return Connection
     */
    public function get(): DbConnection
    {
        if (count($this->availableConnections) === 0) {
            $connection = DbConnection::getInstance();
            $this->inUseConnections[] = $connection;
            return $connection;
        } else {
            $connection = array_pop($this->availableConnections);
            $this->inUseConnections[] = $connection;
            return $connection;
        }
    }

    /**
     * @param Connection $connection
     *
     * @return void
     */
    public function release(DbConnection $connection): void
    {
        $index = array_search($connection, $this->inUseConnections, true);
        if ($index !== false) {
            unset($this->inUseConnections[$index]);
            $this->availableConnections[] = $connection;
        }
    }
}