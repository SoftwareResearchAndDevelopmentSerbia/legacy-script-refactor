<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Factory;

use Model\User;

class UserFactory
{
    /**
     * @param string $class
     * @param array $data
     *
     * @return User
     */
    public  static function create(string $class = User::class, array $data = []): User {
        return new $class($data);
    }
}