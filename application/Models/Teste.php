<?php

namespace Models;

use InvalidArgumentException;
use PDO;
use PDOException;

use Config\Database;

class Teste
{
    private $db;
    private $tableName = 'teste';
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getDb();
    }

    public function getAll()
    {
        $query = 'SELECT * from '.$this->tableName;

        $statement = $this->db->query($query);
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result;
    }
}
