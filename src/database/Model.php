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
        $this->statement = new PDOStatement();
    }

    public function find(int $id)
    {
        $query = "SELECT * from {$this->table} WHERE id = {$id}";
        $statement = $this->connection->prepare($query);

        $statement->execute();
        return $statement->fetchObject($this->classPath);
    }

    public function all(string $columns = '*')
    {
        $query = "SELECT {$columns} from {$this->table}";
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, $this->classPath);
    }

    public function create(array $data)
    {
        $data['id'] = null;
        $columns = implode(",", $this->columns);
        foreach ($data as $key => $value) {
            $hasColumn = array_search($key, $this->columns);
            if ($hasColumn === false) {
                return false;
            }
        }
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES (:" . implode(",:", $this->columns) . ")";
        $statement = $this->connection->prepare($query);
        $statement->execute($data);

        $model = $this->find($this->connection->lastInsertId());

        return $model;
    }


    public function where(string $column, string $operator, string $value)
    {
        $query = "SELECT * from {$this->table} WHERE {$column} {$operator} '{$value}'";
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute();
        return $this;
    }

    public function first()
    {
        $this->statement->queryString .= ' LIMIT 1';
        $model = $this->statement->fetchObject($this->classPath);

        if (!$model) {
            return null;
        }
        return $model;
    }

    public function get()
    {
        return $this->statement->fetchAll(PDO::FETCH_CLASS, $this->classPath);
    }
}
