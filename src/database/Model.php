<?php

namespace Ronildo\TodoPhp\database;

use PDO;
use PDOStatement;

abstract class Model
{
    private PDO $connection;
    private PDOStatement $statement;
    private string $classPath;
    protected string $table;
    protected array $columns = [];

    public function __construct()
    {
        $this->classPath = get_class($this);
        $this->connection = Connection::getConnetion();
        $this->statement = $this->connection->prepare("SELECT * FROM {$this->table}");
    }

    public function find(int $id)
    {
        $query = "SELECT * from {$this->table} WHERE id = {$id}";
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute();
        return $this->statement->fetchObject($this->classPath);
    }

    public function all(string $columns = '*', string $orderBy = 'id', string $order = 'DESC')
    {
        $query = "SELECT {$columns} from {$this->table} ORDER BY {$orderBy} {$order}";
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute();

        return $this->statement->fetchAll(PDO::FETCH_CLASS, $this->classPath);
    }

    public function create(array $data)
    {
        if ($this->validateColumns($data)) {
            $query = "INSERT INTO {$this->table} (" . implode(",", array_keys($data)) . ") VALUES (:" . implode(",:", array_keys($data)) . ")";
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($data);

            $model = $this->find($this->connection->lastInsertId());

            return $model;
        }
        return null;
    }

    public function where(string $column, string $operator, string $value)
    {
        $hasWhere = str_contains($this->statement->queryString, 'WHERE');

        $query = $this->statement->queryString . ((!$hasWhere) ? " WHERE" : " AND") . " {$column} {$operator} '{$value}'";

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute();
        return $this;
    }

    public function first()
    {
        $this->statement = $this->connection->prepare($this->statement->queryString . " LIMIT 1");

        $this->statement->execute();
        $model = $this->statement->fetchObject($this->classPath);

        if (!$model) {
            return null;
        }
        return $model;
    }

    public function get()
    {
        $result = $this->statement->fetchAll(PDO::FETCH_CLASS, $this->classPath);
        $this->statement = $this->connection->prepare("SELECT * FROM {$this->table}");
        return $result;
    }

    public function update(array $data)
    {
        if ($this->validateColumns($data)) {
            $binValues = [];
            foreach ($data as $key => $value) {
                if ($key == 'user_id') {
                    unset($data['user_id']);
                    continue;
                }
                $binValues[] = $key . ' = ' . ':' . $key;
            }

            $query = "UPDATE {$this->table} SET " .  implode(', ', $binValues)  . " WHERE id = {$this->id};";

            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($data);

            return true;
        }
        return false;
    }

    public function delete(array $ids = [])
    {
        (!empty($ids)) ? $toDeleteIds = implode(", ", $ids) : $toDeleteIds = implode(", ", (array)$this->id);

        $query = "DELETE FROM {$this->table} WHERE id IN ({$toDeleteIds})";
        $this->statement = $this->connection->prepare($query);

        $result = $this->statement->execute();
        $this->statement = $this->connection->prepare("SELECT * FROM {$this->table}");

        return $result;
    }

    public function orderBy(string $column = 'id', string $order = 'DESC')
    {
        $this->statement = $this->connection->prepare($this->statement->queryString . " ORDER BY {$column} {$order}");
        $this->statement->execute();

        return $this;
    }

    private function validateColumns(array &$data)
    {
        $data['id'] = null;
        foreach ($data as $key => $value) {
            $hasColumn = array_search($key, $this->columns);
            if ($hasColumn === false) {
                return false;
            }
        }
        unset($data['id']);

        return true;
    }
}
