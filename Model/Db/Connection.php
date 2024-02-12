<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Db;

use Exception;
use PDO;
use PDOException;
use const Core\DS;

class Connection extends PDO
{
    private static ?Connection $instance = null;

    private function __construct() {
        $config = 'ConfigDbDefault';
        $confDbIni = ROOT.DS.'Core'.DS.'db.ini.php';

        if (!file_exists($confDbIni)) {
            die('Could not locate database configuration file.');
        }

        $ini = parse_ini_file($confDbIni, true);

        if (!isset($ini[$config])) {
            die('Unknown database configuration.');
        }
        $settings = $ini[$config];
        try {
            $dsn = 'mysql:dbname=' . $settings['dbName'] . ';host=' . $settings['dbHost'];
            parent::__construct($dsn, $settings['dbUser'], $settings['dbPass'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $pdo =  new PDO($dsn, $settings['dbUser'], $settings['dbPass'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            die('Connection failed: '.$e->getMessage());
        }
    }

    private function __clone() {}

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $sql
     * @param $data
     * @param $class
     *
     * @return array
     */
    public function selectStmt($sql = '', $data = [], $class = false): array {
        $return = [];
        try
        {
            $db = self::getInstance();
            $stmt = $db->prepare($sql);
            $ex = $stmt->execute($data);

            if ($ex) {
                if (!empty($class)) {
                    $return = $stmt->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
                    $return = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $return;
    }

    /**
     * @param string $sql
     * @param array $data
     *
     * @return int
     */
    public function insertStmt(string $sql = '', array $data = []): int {
        $return = 0;
        try {
            $db = self::getInstance();
            $stmt = $db->prepare($sql);
            $ex = $stmt->execute($data);

            if ($ex) {
                $return = (int)$db->lastInsertId();
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $return;
    }

    /**
     * @param string $sql
     * @param array $data
     *
     * @return bool
     */
    public function updateStmt(string $sql = '', array $data = []): bool
    {
        $return = false;
        try
        {
            $db = self::getInstance();
            $stmt = $db->prepare($sql);
            $return = $stmt->execute($data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $return;
    }
}