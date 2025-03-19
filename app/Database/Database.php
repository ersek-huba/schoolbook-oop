<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    protected const DEFAULT_CONFIG = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => null,
        'database' => 'school'
    ];
    protected static ?Database $instance = null;
    private PDO $pdo;
    private function __construct(array $config)
    {
        $host = $config['host'] ?? self::DEFAULT_CONFIG['host'];
        $user = $config['user'] ?? self::DEFAULT_CONFIG['user'];
        $password = $config['password'] ?? self::DEFAULT_CONFIG['password'];
        $database = $config['database'] ?? self::DEFAULT_CONFIG['database'];
        try
        {
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        }
        catch (PDOException $e)
        {
            error_log($e->getMessage());
            throw new \RuntimeException("Database connection error.");
        }
    }

    public static function getInstance(array $config = []): Database
    {
        if (self::$instance === null)
        {
            self::$instance = new Database($config);
        }
        return self::$instance;
    }
}