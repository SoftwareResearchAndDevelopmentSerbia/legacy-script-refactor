<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Db\QueryBuilder;

use Exception;
use stdClass;

class AbstractSql implements SqlInterface
{
    /**
     * @var stdClass
     */
    protected stdClass $query;

    /**
     * @return void
     */
    protected function reset(): void
    {
        $this->query = new stdClass();
    }

    /**
     * @param string $table
     * @param array $fields
     *
     * @return SqlInterface
     */
    public function select(string $table, array $fields): SqlInterface
    {
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * @param string $table
     * @param array $fields
     *
     * @return SqlInterface
     */
    public function insert(string $table, array $fields): SqlInterface
    {
        $this->reset();
        $this->query->base = "INSERT INTO " . $table . " (" . implode(", ", array_keys($fields)) . ") "
            . "VALUES (" . implode(", ", array_values($fields)). ")";
        $this->query->type = 'insert';

        return $this;
    }

    /**
     * @param string $table
     * @param array $fields
     * @param bool $prepared
     *
     * @return SqlInterface
     */
    public function update(string $table, array $fields, bool $prepared = false): SqlInterface
    {
        $this->reset();
        $cols = [];
        foreach ($fields as $column => $value) {
            if ($prepared) {
                $cols[] = "{$column} = {$value}";
            } else {
                $cols[] = "{$column} = '{$value}'";
            }
        }
        $this->query->base = "UPDATE " . $table . " SET " . implode(", ", $cols) . " ";
        $this->query->type = 'update';

        return $this;
    }

    /**
     * @param string $field
     * @param string $value
     * @param string $operator
     * @param bool $prepared
     *
     * @return SqlInterface
     * @throws Exception
     */
    public function where(string $field, string $value, string $operator = '=', bool $prepared = false): SqlInterface
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        $wherePart = "$field $operator '$value'";
        if ($prepared) {
            $wherePart = "$field $operator $value";
        }
        $this->query->where[] = $wherePart;

        return $this;
    }

    /**
     * @param int $start
     * @param int $offset
     *
     * @return SqlInterface
     * @throws Exception
     */
    public function limit(int $start, int $offset): SqlInterface
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new Exception("LIMIT can only be added to SELECT");
        }
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    /**
     * @param bool $prepared
     * @return string
     */
    public function getSQL(bool $prepared = false): string
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        if (!$prepared) {
            $sql .= ";";
        }
        return $sql;
    }
}