<?php

namespace Config;

class Database
{
    private static $instance;
    private $db;

    //database credentials
    private $host = 'postgres';
    private $user = 'db_user';
    private $pass = 'db_password';
    private $db_name = 'postgres';
    private $dsn; 


    public function __construct()
    {
        $this->dsn = "pgsql:host=$this->host;port=5432;dbname=$this->db_name;";
        $this->db = $this->connectToDatabase();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connectToDatabase()
    {
        try {
            return new \PDO($this->dsn, $this->user, $this->pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function getDb()
    {
        return $this->db;
    }
}
