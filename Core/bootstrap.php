<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Core;

require_once 'helpers.php';

spl_autoload_register(function(string $className = '') {
    require_once 'config.php';
    $className = str_replace('\\', DS, $className);
    $fileName = ROOT.DS.$className.'.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    } else {
        header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error', true, 500);
        die('500 Internal Server Error.');
    }
});