<?php

namespace AddressJockey\LibraryDatabases;

class PdoAdapter implements DatabaseAdapterInterface
{
    protected $connection;
    protected $statement;
    protected $fetchMode = \PDO::FETCH_ASSOC;

    public function __construct($c)
    {
        $this->connection = $c->db;
    }

    public function getStatement()
    {
        if ($this->statement === null) {
            throw new PDOException("There is no PDOStatement object for use");
        }

        return $this->statement;
    }

    public function prepare($sql, array $options = array())
    {
        try {
            $this->statement = $this->connection->prepare($sql, $options);
            return $this;
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function execute(array $parameters = array())
    {
        try {
            $this->getStatement()->execute($parameters);
            return $this;
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function fetch(
        $fetchStyle = null,
        $cursorOrientation = null,
        $cursorOffset = null
    ) {
        if ($fetchStyle === null) {
            $fetchStyle = $this->fetchMode;
        }

        try {
            return $this->getStatement()->fetch(
                $fetchStyle,
                $cursorOrientation,
                $cursorOffset
            );
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function fetchAll($fetchStyle = null, $column = 0)
    {
        if ($fetchStyle === null) {
            $fetchStyle = $this->fetchMode;
        }

        try {
            return $fetchStyle === \PDO::FETCH_COLUMN
               ? $this->getStatement()->fetchAll($fetchStyle, $column)
               : $this->getStatement()->fetchAll($fetchStyle);
        } catch (PDOException $e) {
            throw new RunTimeException($e->getMessage());
        }
    }

    public function select($table, array $bind = array(), $boolOperator = "AND")
    {
        if ($bind) {
            $where = array();
            foreach ($bind as $col => $value) {
                unset($bind[$col]);
                $bind[":" . $col] = $value;
                $where[] = $col . " = :" . $col;
            }
        }

        $sql = "SELECT * FROM " . $table
            . (($bind) ? " WHERE "
            . implode(" " . $boolOperator . " ", $where) : " ");
        $this->prepare($sql)
            ->execute($bind);
        return $this;
    }
}
