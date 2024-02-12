<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Model\User;
use Model\Validator\ValidationResult;

interface RegistrationPersistenceInterface
{
    /**
     * @param ValidationResult $validationResult
     * @param User $user
     *
     * @return User
     */
    public function execute(ValidationResult $validationResult, User $user): User;
}