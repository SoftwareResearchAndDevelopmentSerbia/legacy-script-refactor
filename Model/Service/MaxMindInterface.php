<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

/**
 * @api 1.0.0
 */
interface MaxMindInterface
{
    /**
     * @param string $email
     * @param string $ip
     *
     * @return bool
     */
    public function validateUser(string $email, string $ip): bool;
}