<?php

namespace Models;

use Config\Database;

class Category
{
    private $db;
    private $tableName = 'category';
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

    public function findByPk($id)
    {
        $query = 'SELECT * from ' . $this->tableName . ' WHERE id = :id';

        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result;
    }

    public function insert($name, $tax_percent)
    {
            $insert = 'INSERT INTO '.$this->tableName.' (name, tax_percent) VALUES (:name, :tax_percent)';

            $statement = $this->db->prepare($insert);

            $statement->bindParam(':name', $name);
            $statement->bindParam(':tax_percent', $tax_percent);

            $statement->execute();

            $result = [
                "status" => $statement->rowCount() > 0 ? true : false,
                "id" => $this->db->lastInsertId()
            ];
            return $result;
    }

    public function update($id, $name, $tax_percent){
        $category = $this->findByPk($id);
        $name = $name == null ? $category[0]['name'] : $name;
        $tax_percent = $tax_percent == null ? $category[0]['tax_percent'] : $tax_percent;

        $update = 'UPDATE '.$this->tableName.' set name = :name, tax_percent = :tax_percent WHERE id = :id';

        $statement = $this->db->prepare($update);

        $statement->bindParam(':name', $name);
        $statement->bindParam(':tax_percent', $tax_percent);
        $statement->bindParam(':id', $id);
        
        $statement->execute();
        return $statement->rowCount() > 0 ? true : false;
    }

    public function delete($id){
        $delete = 'DELETE FROM '.$this->tableName.' where id = :id';
        $statement = $this->db->prepare($delete);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->rowCount() > 0 ? true : false;
    }

    public function lastInsertedId(){
        return $this->db->lastInsertId();
    }

}
