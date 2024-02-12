<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

interface SessionManagerInterface
{
    /**
     * @return SessionManager
     */
    public function start(): SessionManager;
}