<?php

namespace Models;

use Config\Database;
use Ramsey\Uuid\Uuid;
class Item
{
    private $db;
    private $tableName = 'item';
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

    public function getAllCompleteScope()
    {
        $query = 'select i.id, i.name, i.description, i.price, i.codigo, c.name as "category", c.tax_percent 
        from '. $this->tableName .' i
        inner join category c on c.id = i.category_id';

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

    public function insert($price, $name, $category_id, $codigo, $description = null,)
    {   
            $uuid = Uuid::uuid4();
            $insert = 'INSERT INTO '.$this->tableName.' (price, name, description, category_id, id, codigo) VALUES (:price, :name, :description, :category_id, :id, :codigo)';

            $statement = $this->db->prepare($insert);

            $statement->bindParam(':price', $price);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':category_id', $category_id);
            $statement->bindParam(':codigo', $codigo);
            $statement->bindParam(':id', $uuid);

            $statement->execute();

            $result = [
                "status" => $statement->rowCount() > 0 ? true : false,
                "id" => $uuid
            ];
            return $result;
    }

    public function update($id, $price, $name, $description, $category_id, $code){
        $item = $this->findByPk($id);
        $price = $price == null ? $item[0]['price'] : $price;
        $name = $name == null ? $item[0]['name'] : $name;
        $description = $description == null ? $item[0]['description'] : $description;
        $category_id = $category_id == null ? $item[0]['category_id'] : $category_id;
        $code = $code == null ? $item[0]['codigo'] : $code;

        $update = 'UPDATE '.$this->tableName.' set price = :price, name = :name, description = :description, category_id = :category_id, codigo = :codigo WHERE id = :id';

        $statement = $this->db->prepare($update);

        $statement->bindParam(':price', $price);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':category_id', $category_id);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':codigo', $code);
        
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

    public function findByCodigo($codigo){
        $query = 'select i.id, i.name, i.description, i.price, i.codigo, c.name as "category", c.tax_percent 
        from item i
        inner join category c on c.id = i.category_id where i.codigo = :codigo';

        $statement = $this->db->prepare($query);
        $statement->bindParam(':codigo', $codigo);
        $statement->execute();
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result; 
    }

    public function lastInsertedId(){
        return $this->db->lastInsertId();
    }

}
