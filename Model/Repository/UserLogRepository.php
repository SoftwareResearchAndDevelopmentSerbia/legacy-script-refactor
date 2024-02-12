<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Repository;

use Model\Db\ConnectionPool;
use Model\Db\QueryBuilder\Mysql as MysqlQueryBuilder;
use Model\UserLog;

class UserLogRepository implements UserLogRepositoryInterface
{
    /**
     * @param UserLog $userLog
     *
     * @return UserLog
     */
    public function save(UserLog $userLog): UserLog
    {
        $pool = new ConnectionPool();
        $connection = $pool->get();

        $queryBuilder = new MysqlQueryBuilder();
        $bindParameters = [':action' => 'register', ':user_id' => $userLog->getData('user_id')];
        $insertData = [
            'action' => ':action',
            'user_id' => ':user_id',
        ];
        $query = $queryBuilder
            ->insert($userLog->getTable(), $insertData)
            ->getSQL(true);

        $id = $connection->insertStmt($query, $bindParameters);
        $userLog->setData('id', $id);
        $pool->release($connection);

        return $userLog;
    }
}