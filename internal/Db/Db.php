<?php

class Db
{
    private $connection;
    private PDOStatement $stmt;
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) 
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(array $db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try
        {
            $this->connection = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
        }
        catch (PDOException $e) 
        {
            echo "DB Error: {$e->getMessage()}";
            die;
        }
    }

    public function query($query, $params = array())
    {   
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }

    public function findAll()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find()
    {
        return $this->stmt->fetch();
    }

}