<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

class SessionStorage implements SessionStorageInterface
{
    /**
     * @param string $namespace
     * @param array $data
     */
    public function __construct(
        protected string $namespace = 'default',
        protected array $data = []
    ) {
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function init(array $data): void
    {
        $namespace = $this->getNamespace();
        if (isset($data[$namespace])) {
            $this->setData($data[$namespace]);
        }
        $_SESSION[$namespace] = & $this->data;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string|array $key
     * @param mixed $value
     *
     * @return $this
     */
    public function setData(string|array $key, mixed $value = null): SessionStorage
    {
        if ($key === (array)$key) {
            $this->data = $key;
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }
}