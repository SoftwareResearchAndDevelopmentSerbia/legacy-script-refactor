<?php
/**
 * Copyright © Software Research and Development. All rights reserved.
 * See LICENSE_SOFTWARE_RESEARCH_AND_DEVELOPMENT.txt for license details.
 */
declare(strict_types=1);

namespace Model\Db\QueryBuilder;

interface SqlInterface
{
    /**
     * @param string $table
     * @param array $fields
     *
     * @return SqlInterface
     */
    public function select(string $table, array $fields): SqlInterface;

    /**
     * @param string $table
     * @param array $fields
     *
     * @return SqlInterface
     */
    public function insert(string $table, array $fields): SqlInterface;

    /**
     * @param string $table
     * @param array $fields
     * @param bool $prepared
     *
     * @return SqlInterface
     */
    public function update(string $table, array $fields, bool $prepared = false): SqlInterface;

    /**
     * @param string $field
     * @param string $value
     * @param string $operator
     * @param bool $prepared
     *
     * @return SqlInterface
     */
    public function where(string $field, string $value, string $operator = '=', bool $prepared = false): SqlInterface;

    /**
     * @param int $start
     * @param int $offset
     *
     * @return SqlInterface
     */
    public function limit(int $start, int $offset): SqlInterface;

    /**
     * @param bool $prepared
     * @return string
     */
    public function getSQL(bool $prepared = false): string;
}