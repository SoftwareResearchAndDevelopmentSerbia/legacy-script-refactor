<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Exception;
use Model\User;

class EmailSending implements EmailSendingInterface
{
    /**
     * @param User $user
     *
     * @return void
     */
    public function execute(User $user): void
    {
        try {
            $email = $user->getData('email');
            $subject = 'Dobro došli';
            $message = 'Dobro dosli na nas sajt. Potrebno je samo da potvrdite email adresu ...';
            $headers = 'adm@kupujemprodajem.com';
            mail($email, $subject,  $message, $headers);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }
}