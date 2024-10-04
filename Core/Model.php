<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    protected $connection;
    protected $statement;

    public function __construct()
    {
        try {
            if (DB_TYPE === 'mysql') {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
                $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            } elseif (DB_TYPE === 'sqlite') {
                $dsn = "sqlite:" . SQLITE_PATH;
                $this->connection = new PDO($dsn);
            }

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Bağlantı hatası: " . $e->getMessage();
        }
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function first()
    {
        return $this->statement->fetch();
    }

    public function firstOrFail()
    {
        $result = $this->first();
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
