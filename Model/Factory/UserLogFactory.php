<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Factory;

use Model\UserLog;

class UserLogFactory
{
    /**
     * @param string $class
     * @param array $data
     *
     * @return UserLog
     */
    public  static function create(string $class = UserLog::class, array $data = []): UserLog {
        return new $class($data);
    }
}