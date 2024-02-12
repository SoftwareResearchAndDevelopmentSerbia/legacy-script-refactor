<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace api\v1\users;

use Model\Service\RegisterUser as RegisterUserService;

require_once '../../../Core/bootstrap.php';

if ((strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest'
    || isset($_SERVER['HTTP_POSTMAN_TOKEN']))
    && $_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty($_POST)) {

    $registerUserService = new RegisterUserService();
    $registerUserService->execute($_POST);

    header('Content-Type: application/json');
    echo json_encode($registerUserService->getReturnResult());
} else {
    header("HTTP/1.0 404 Not Found");
}
die();

