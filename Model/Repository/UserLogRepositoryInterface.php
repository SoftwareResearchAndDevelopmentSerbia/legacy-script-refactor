<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Repository;

use Model\UserLog;

interface UserLogRepositoryInterface
{
    /**
     * @param UserLog $userLog
     *
     * @return UserLog
     */
    public function save(UserLog $userLog): UserLog;
}