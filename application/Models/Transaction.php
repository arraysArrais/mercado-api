<?php

namespace Models;

use Config\Database;

class Transaction
{
    private $db;
    private $tableName = 'transaction';
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

    public function insert($items)
    {
        //cria registro de venda
        $insertTransaction = 'INSERT INTO ' . $this->tableName . '(created_date) VALUES (CURRENT_TIMESTAMP)';
        $statementTransaction = $this->db->prepare($insertTransaction);
        $statementTransaction->execute();
        $idTransaction = $this->lastInsertedId();
        $result = [
            "status" => $statementTransaction->rowCount() > 0 ? true : false,
            "id" => $idTransaction
        ];

        //associa os produtos ao registro de venda
        foreach ($items as $item) {
            $insertTransactionItem = 'INSERT INTO transaction_item (transaction_id, item_id) VALUES (:transaction_id, :item_id)';
            $statementTransactionItem = $this->db->prepare($insertTransactionItem);
            $statementTransactionItem->bindParam(':transaction_id', $idTransaction);
            $statementTransactionItem->bindParam(':item_id', $item['id_item']);
            $statementTransactionItem->execute();
        }
        return $result;
    }

    public function findByPk($id)
    {
        $query = 'SELECT * from ' . $this->tableName . ' t INNER JOIN transaction_item ti on ti.transaction_id = t.id WHERE id = :id';

        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result;
    }

    public function getTransactionWithItems($transaction_id)
    {
        $query = 'select t.id as "id_transaction", ti.item_id, i.name, i.price, i.description, i.codigo, c.name as "categoria", c.tax_percent as "percentual_imposto", created_date
        from transaction t
        inner join transaction_item ti on t.id = ti.transaction_id 
        inner join item i on i.id = ti.item_id 
        inner join category c on c.id = i.category_id
        where t.id = :transaction_id';

        $statement = $this->db->prepare($query);
        $statement->bindParam(':transaction_id', $transaction_id);
        $statement->execute();
        $result = $statement->fetchAll($this->db::FETCH_ASSOC);
        return $result;
    }

    public function lastInsertedId()
    {
        return $this->db->lastInsertId();
    }
}
