<?php

namespace App\Models;

use App\Database\Database;
use App\Interfaces\ModelInterface;

abstract class Model implements ModelInterface
{
    public int $id;
    protected $db;
    protected static $table;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    function mapToModel(array $data): Model
    {
        $model = new static();
        foreach ($data as $key => $value)
        {
            if (property_exists($model, $key))
            {
                $model->$key = $value;
            }
        }
        return $model;
    }
    static function select(): string
    {
        return "SELECT * FROM `" . static::$table . "` ";
    }

    static function orderBy($orderBy = []): string
    {
        if (empty($orderBy))
        {
            return "";
        }
        $orderByClauses = [];
        $fields = $orderBy['order_by'] ?? [];
        $directions = $orderBy['direction'] ?? [];
        foreach ($fields as $index => $field)
        {
            $direction = $directions[$index] ?? 'ASC';
            $orderByClauses[] = "$field $direction";
        }
        if (empty($orderByClauses))
        {
            return "";
        }
        return " ORDER BY " . implode(', ', $orderByClauses) . ";";
    }
    function find(int $id): ?static
    {
        $sql = self::select() . " WHERE id = :id";
        $queryResult = $this->db->execSql($sql, ['id' => $id]);
        if (empty($queryResult))
        {
            return null;
        }
        return $this->mapToModel($queryResult[0]);
    }
    function all($orderBy = []): array
    {
        $sql = self::select();
        $sql .= self::orderBy($orderBy);
        $queryResult = $this->db->execSql($sql);
        if (empty($queryResult))
        {
            return [];
        }
        $results = [];
        foreach ($queryResult as $row)
        {
            $results[] = $this->mapToModel($row);
        }
        return $results;
    }
    function delete(): bool
    {
        $sql = "DELETE FROM `" . self::$table . "` WHERE id = :id";
        $queryResult = $this->db->execSql($sql, ['id' => $this->id]);
        return $queryResult;
    }
    public function create()
    {
        $properties = get_object_vars($this);
        unset($properties['id']);
        unset($properties['db']);
        unset($properties['table']);
        $columns = implode(', ', array_keys($properties));
        $placeholders = [];
        foreach (array_keys($properties) as $key)
        {
            $placeholders[] = ":$key";
        }
        $placeholders = implode(', ', $placeholders);
        $sql = "INSERT INTO `" . static::$table . "` ($columns) VALUES ($placeholders)";
        return $this->db->execSql($sql, $properties);
    }
 
    public function update()
    {
        $properties = get_object_vars($this);
        unset($properties['db']);
        unset($properties['table']);
        $id = $properties['id'] ?? null;
        if ($id === null)
        {
            $_SESSION['error_message'] = "Egyedi azonosító nincs megadva!";
            return false;
        }
        unset($properties['id']);
        $setClauseParts = [];
        foreach (array_keys($properties) as $key)
        {
            $setClauseParts[] = "$key = :$key";
        }
        $setClause = implode(', ', $setClauseParts);
        $sql = "UPDATE `" . static::$table . "` SET $setClause WHERE id = :id";
        $properties['id'] = $id;
        return $this->db->execSql($sql, $properties);
    }
}