<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Validator\MaxMind;

use Model\Validator\AbstractValidator;
use Model\Validator\ValidationResult;
use Model\Service\MaxMind as MaxMindService;

class ValidateUser extends AbstractValidator
{
    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult
    {
        $maxMindService = new MaxMindService();
        $validateUser = $maxMindService->validateUser($this->arguments[0] ?? '', $this->arguments[1] ?? '');
        if ($validateUser) {
            return new ValidationResult(['max_mind_invalid']);
        } else {
            return parent::validate();
        }
    }
}