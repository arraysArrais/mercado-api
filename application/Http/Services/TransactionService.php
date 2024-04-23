<?php

namespace Services;

use Models\Transaction;

class TransactionSvc{

    private $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function createAndAssociateItems($body){
        return $this->transaction->insert();
    }

    public function findByPk($id){
        return $this->transaction->findByPk($id);
    }
}