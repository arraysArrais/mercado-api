<?php

namespace Models;

use Config\Database;
class Transaction
{
    private $db;
    private $tableName = 'transaction_item';
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getDb();
    }

    public function getAll()
    {
        $query = 'SELECT * from ' . $this->tableName;

        $statement = $this->db->query($query);
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result;
    }

    public function insert()
    {   
           
    }

    public function findByPk(){
        
    }

    public function lastInsertedId(){
        return $this->db->lastInsertId();
    }

}
