<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model;

abstract class AbstractModel
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @param array $properties
     */
    public function __construct(array $properties = []){
        $this->data = $properties;
    }

    /**
     * @param string $property
     * @param string $value
     *
     * @return string
     */
    public function __set(string $property, string $value = '') {
        return $this->data[$property] = $value;
    }

    /**
     * @param string $property
     *
     * @return mixed|null
     */
    public function __get(string $property) {
        return array_key_exists($property, $this->data)
            ? $this->data[$property]
            : null
            ;
    }

    /**
     * @param string|array $key
     * @param $value
     *
     * @return $this
     */
    public function setData(string|array $key, $value = null): AbstractModel
    {
        if ($key === (array)$key) {
            $this->data = $key;
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getData(string $key) {
        return $this->data[$key] ?? '';
    }

    /**
     * @return string
     */
    public function getTable(): string {
        return $this->table;
    }
}