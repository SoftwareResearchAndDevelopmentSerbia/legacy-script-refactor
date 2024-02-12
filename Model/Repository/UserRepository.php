<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Repository;

use Model\Db\ConnectionPool;
use Model\Db\QueryBuilder\Mysql as MysqlQueryBuilder;
use Model\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return User
     */
    public function save(User $user): User
    {
        $pool = new ConnectionPool();
        $connection = $pool->get();

        $queryBuilder = new MysqlQueryBuilder();
        $bindParameters = [':email' => $user->getData('email'), ':password' => $user->getData('password')];
        $insertData = [
            'email' => ':email',
            'password' => ':password'
        ];

        $query = $queryBuilder
            ->insert($user->getTable(), $insertData)
            ->getSQL(true);

        $id = $connection->insertStmt($query, $bindParameters);
        $user->setData('id', $id);
        $pool->release($connection);

        return $user;
    }

    /**
     * @param string $email
     *
     * @return User|array
     */
    public function getByEmail(string $email = ''): User|array
    {
        $pool = new ConnectionPool();
        $connection = $pool->get();
        $queryBuilder = new MysqlQueryBuilder();
        $bindParameters = [':email' => $email];
        $query = $queryBuilder
            ->select('user', ['*'])
            ->where('email', array_keys($bindParameters)[0], '=', true)
            ->getSQL(true);
        $user = $connection->selectStmt($query, $bindParameters, User::class);
        $pool->release($connection);

        $user = !empty($user[0]) ? $user[0] : $user;
        if ($user instanceof User) {
            $userData = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ];
            $user->setData($userData);
        }

        return $user;
    }
}