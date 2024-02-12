<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Validator\User;

use Model\User;
use Model\Validator\AbstractValidator;
use Model\Validator\ValidationResult;
use Model\Repository\UserRepository;

class UserExists extends AbstractValidator
{
    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getByEmail($this->arguments[0]);
        if ($user instanceof User && $user->getId()) {
            return new ValidationResult(['user_exists']);
        } else {
            return parent::validate();
        }
    }
}