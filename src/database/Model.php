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
        $data['id'] = null;
        $columns = implode(",", $this->columns);
        foreach ($data as $key => $value) {
            $hasColumn = array_search($key, $this->columns);
            if ($hasColumn === false) {
                return false;
            }
        }
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES (:" . implode(",:", $this->columns) . ")";
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($data);

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
        return $this->statement->fetchAll(PDO::FETCH_CLASS, $this->classPath);
    }

    public function orderBy(string $column = 'id', string $order = 'DESC')
    {
        $this->statement = $this->connection->prepare($this->statement->queryString . " ORDER BY {$column} {$order}");
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_CLASS, $this->classPath);
    }
}
