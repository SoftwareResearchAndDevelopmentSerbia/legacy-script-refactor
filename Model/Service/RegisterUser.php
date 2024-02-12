<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Service;

use Model\Factory\UserFactory;
use Model\User;
use Model\Service\RegistrationValidator as RegistrationValidationService;
use Model\Service\RegistrationPersistence as RegistrationPersistenceService;
use Model\Service\EmailSending as EmailSendingService;
use Model\Service\SessionManager as SessionManagerService;
use Model\Service\SessionStorage as SessionStorageService;
use function Core\getIp;

class RegisterUser implements RegisterUserInterface
{
    /**
     * @var array
     */
    protected array $returnResult = [
        'data' => [],
        'success' => false,
        'message' => []
    ];

    /**
     * @param array $postRequestData
     *
     * @return void
     */
    public function execute(array $postRequestData): void {
        $email = $postRequestData['email'] ?? '';
        $password = $postRequestData['password'] ?? '';
        $passwordTwo = $postRequestData['password_two'] ?? '';
        $ip = getIp();

        /**
         * Create user object via Factory
         */
        $userData = [
            'email' => $email,
            'password' => $password,
            'passwordTwo' => $passwordTwo,
            'ip' => $ip
        ];
        $user = UserFactory::create(User::class, $userData);

        /**
         * Registration Validation Service
         */
        $registrationValidationService = new RegistrationValidationService();
        $validationResult = $registrationValidationService->execute(
            $email, $password, $passwordTwo, $ip
        );

        $this->returnResult['success'] = $validationResult?->isValid();
        $this->returnResult['message'] = $validationResult?->getErrors();

        /**
         * Registration Persistence Service
         */
        $registrationPersistenceService = new RegistrationPersistenceService();
        $registrationPersistenceService->execute($validationResult, $user);
        if (!empty($user->getData('id'))) {
            $this->returnResult['data'] = ['userId' => $user->getData('id')];
        }

        /**
         * Email sending service
         */
        $emailSendingService = new EmailSendingService();
        $emailSendingService->execute($user);

        /**
         * Session manager service
         */
        if ($user->getData('id')) {
            $sessionNamespace = 'default';
            $sessionData = ['userId' => $user->getData('id')];
            $sessionStorageService = new SessionStorageService($sessionNamespace, $sessionData);
            $sessionManagerService = new SessionManagerService($sessionStorageService);
        }
    }

    /**
     * @return array
     */
    public function getReturnResult(): array {
        return $this->returnResult;
    }
}