<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Core;

date_default_timezone_set('Europe/Belgrade');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set('html_errors', 1);
ini_set('log_errors', 1);

const DS = DIRECTORY_SEPARATOR;
define('ROOT', dirname(__FILE__, 2));
const INVALID_USER_EMAIL = 'invalid@gmail.com';