<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Model\Validator\ValidationResult;

/**
 * @api 1.0.0
 */
interface RegistrationValidatorInterface
{
    /**
     * @param string $email
     * @param string $password
     * @param string $passwordTwo
     * @param string $ip
     *
     * @return ValidationResult
     */
    public function execute(string $email = '', string $password = '', string $passwordTwo = '',
                            string $ip = ''): ValidationResult;
}
