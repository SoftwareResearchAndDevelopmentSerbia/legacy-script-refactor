<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Validator\Password;

use Model\Validator\AbstractValidator;
use Model\Validator\ValidationResult;

class Length extends AbstractValidator
{
    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult
    {
        if (empty($this->arguments[0]) || mb_strlen($this->arguments[0]) < 8) {
            return new ValidationResult(['password_length']);
        } else {
            return parent::validate();
        }
    }
}