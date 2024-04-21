<?php

namespace Models;

use Config\Database;
use Helpers\HttpHelpers;

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

    public function findByPk($id)
    {
        $query = 'SELECT * from ' . $this->tableName . ' WHERE id = :id';

        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result;
    }

    public function insert($price, $name, $description = null, $category_id)
    {

        if ($price != null && $name != null && $category_id != null) {
            $insert = 'INSERT INTO '.$this->tableName.' (price, name, description, category_id) VALUES (:price, :name, :description, :category_id)';

            $statement = $this->db->prepare($insert);

            $statement->bindParam(':price', $price);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':category_id', $category_id);

            $statement->execute();

            return $statement->rowCount() > 0 ? true : false;
        }

        return HttpHelpers::jsonResponse(422, ['error' => 'Os campos price, name e category_id são obrigatórios']);
    }

    public function update($id, $price, $name, $description, $category_id){
        $item = $this->findByPk($id);

        $price = $price === null ? $item['price'] : $price;
        $name = $name === null ? $item['name'] : $name;
        $description = $description === null ? $item['description'] : $description;
        $category_id = $category_id === null ? $item['categor$category_id'] : $category_id;

        $update = 'UPDATE '.$this->tableName.' set price = :price, name = :name, description = :description, category_id = :category_id WHERE id = :id';

        $statement = $this->db->prepare($update);

        $statement->bindParam(':price', $price);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':category_id', $category_id);
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


}
