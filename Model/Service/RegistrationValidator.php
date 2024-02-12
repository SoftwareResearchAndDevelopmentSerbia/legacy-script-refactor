<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Model\Validator\Email\Format as EmailFormatValidator;
use Model\Validator\MaxMind\ValidateUser as MaxMindValidateUser;
use Model\Validator\Password\Length as PasswordLengthValidator;
use Model\Validator\Password\MatchThem as MatchPasswordsValidator;
use Model\Validator\User\UserExists as UserExistsValidator;
use Model\Validator\ValidationResult;

class RegistrationValidator implements RegistrationValidatorInterface
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
                            string $ip = ''): ValidationResult
    {
        $emailFormatValidator = new EmailFormatValidator([$email]);
        $passwordLengthValidator = new PasswordLengthValidator([$password]);
        $password2LengthValidator = new PasswordLengthValidator([$passwordTwo]);
        $matchPasswordsValidator = new MatchPasswordsValidator([$password, $passwordTwo]);
        $userExistsValidator = new UserExistsValidator([$email]);
        $maxMindValidateUser = new MaxMindValidateUser([$email, $ip]);
        $emailFormatValidator
            ->setNext($passwordLengthValidator)
            ->setNext($password2LengthValidator)
            ->setNext($matchPasswordsValidator)
            ->setNext($userExistsValidator)
            ->setNext($maxMindValidateUser);

        return $emailFormatValidator->validate();;
    }
}