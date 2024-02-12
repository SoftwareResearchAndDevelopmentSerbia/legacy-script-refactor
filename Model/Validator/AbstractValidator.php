<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Validator;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $nextValidator;

    /**
     * @param array $arguments
     */
    public function __construct(protected array $arguments = []) {}

    /**
     * @param ValidatorInterface $validator
     *
     * @return ValidatorInterface
     */
    public function setNext(ValidatorInterface $validator): ValidatorInterface
    {
        $this->nextValidator = $validator;
        return $validator;
    }

    /**
     * @return ValidationResult
     */
    public function validate(): ValidationResult
    {
        if ($this->nextValidator ?? null) {
            return $this->nextValidator->validate();
        }
        return new ValidationResult([]);
    }
}
