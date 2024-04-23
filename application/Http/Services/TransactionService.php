<?php

namespace Services;

use Models\Transaction;

class TransactionService{

    private $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function createAndAssociateItems($body){

        $items = [];
        foreach($body as $requestPayloadItem){
            array_push($items, [
                "id_item" => $requestPayloadItem->db_id,
                "valor_item" => number_format(($requestPayloadItem->Valor + $requestPayloadItem->Imposto), 2) //valor com imposto
            ]);
        }
        return $this->transaction->insert($items);
    }

    public function findByPk($id){
        return $this->transaction->findByPk($id);
    }

    public function findWithItems($id){
        return $this->transaction->getTransactionWithItems($id);
    }

    public function findAllWihtItems(){
        return $this->transaction->getAllTransactionsWithItems();
    }
}