<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use InvalidArgumentException;

class SessionManager implements SessionManagerInterface
{
    /**
     * @param SessionStorage $storage
     */
    public function __construct(
        protected SessionStorage $storage
    ) {
        $this->start();
    }

    /**
     * @return $this
     */
    public function start(): SessionManager
    {
        session_start();
        $this->storage->init($_SESSION ?? []);
        return $this;
    }

    /**
     * @param string $method
     * @param array $args
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __call(string $method, array $args)
    {
        if (!in_array(substr($method, 0, 3), ['get', 'set', 'uns', 'has'])) {
            throw new InvalidArgumentException(
                sprintf('Invalid method %s::%s(%s)', get_class($this), $method, print_r($args, 1))
            );
        }
        $return = call_user_func_array([$this->storage, $method], $args);
        return $return === $this->storage ? $this : $return;
    }
}