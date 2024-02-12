<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

interface SessionStorageInterface
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function init(array $data): void;

    /**
     * @return string
     */
    public function getNamespace(): string;

    /**
     * @param string|array $key
     * @param mixed $value
     *
     * @return SessionStorage
     */
    public function setData(string|array $key, mixed $value = null): SessionStorage;
}