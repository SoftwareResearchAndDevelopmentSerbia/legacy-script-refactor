<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Model\User;

interface EmailSendingInterface
{
    /**
     * @param User $user
     *
     * @return void
     */
    public function execute(User $user): void;
}