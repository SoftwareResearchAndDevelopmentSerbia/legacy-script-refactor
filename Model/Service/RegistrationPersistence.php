<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Model\Db\ConnectionPool;
use Model\Factory\UserLogFactory;
use Model\Repository\UserLogRepository;
use Model\Repository\UserRepository;
use Model\User;
use Model\UserLog;
use Model\Validator\ValidationResult;
use Model\Db\QueryBuilder\Mysql as MySqlQueryBuilder;

class RegistrationPersistence implements RegistrationPersistenceInterface
{
    /**
     * @param ValidationResult $validationResult
     * @param User $user
     *
     * @return User
     */
    public function execute(ValidationResult $validationResult, User $user): User
    {
        if ($validationResult?->isValid()) {
            /**
             * User Repository
             */
            $userRepository = new UserRepository();
            $userRepository->save($user);

            /**
             * UserLog repository
             */
            $userLogData = [
                'user_id' => $user->getData('id')
            ];
            $userLog = UserLogFactory::create(UserLog::class, $userLogData);
            $userLogRepository = new UserLogRepository();
            $userLogRepository->save($userLog);

            // Code below has been added for demo purpose just to display how it can be properly used
//            /**
//             * Update method test
//             */
//            $pool = new ConnectionPool();
//            $connection = $pool->get();
//            $queryBuilder = new MysqlQueryBuilder();
//            $bindParameters = [':password' => 'test', ':email' => $user->getEmail()];
//            $insertData = [
//                'password' => ':password',
//                'email' => ':email',
//            ];
//
//            $query = $queryBuilder
//                ->update('user', $insertData, true)
//                ->where('email', array_keys($bindParameters)[1], '=', true)
//                ->getSQL(true);
//
//            $update = $connection->updateStmt($query, $bindParameters);
//
//            /**
//             * Mysql expression in where clause
//             */
//            $query = $queryBuilder
//                ->select('user_log', ['*'])
//                ->where('log_time', 'NOW() - INTERVAL 10 DAY', '>', true)
//                ->getSQL(true);
//            $tenDaysLogs = $connection->selectStmt($query);
//
//            $pool->release($connection);
        }
        return $user;
    }
}