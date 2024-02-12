<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Validator\Password;

use Model\Validator\AbstractValidator;
use Model\Validator\ValidationResult;

class MatchThem extends AbstractValidator
{
    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult
    {
        if ($this->arguments[0] !== $this->arguments[1]) {
            return new ValidationResult(['password_mismatch']);
        } else {
            return parent::validate();
        }
    }
}