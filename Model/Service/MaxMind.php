<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use const Core\INVALID_USER_EMAIL;

class MaxMind implements MaxMindInterface
{
    /**
     * @param string $email
     * @param string $ip
     *
     * @return bool
     */
    public function validateUser(string $email, string $ip): bool
    {
        $result = false;
        /**
         * Hard coded false value means validation passes
         * Use @see https://www.php.net/manual/en/book.curl.php for real api connection attempt
         */
        if ($email === INVALID_USER_EMAIL) {
            $result = true;
        }
        return $result;
    }
}