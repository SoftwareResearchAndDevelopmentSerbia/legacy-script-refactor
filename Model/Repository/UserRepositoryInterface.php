<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Repository;

use Model\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     *
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param string $email
     *
     * @return User|array
     */
    public function getByEmail(string $email = ''): User|array;
}