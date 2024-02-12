<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Validator;

use Model\Validator\ValidationResult;

interface ValidatorInterface
{
    /**
     * @param ValidatorInterface $validator
     *
     * @return ValidatorInterface
     */
    public function setNext(ValidatorInterface $validator): ValidatorInterface;

    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult;
}