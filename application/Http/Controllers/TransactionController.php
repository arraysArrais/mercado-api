<?php

namespace Http\Controllers;

use Throwable;
use Helpers\HttpHelpers;
use Laminas\Diactoros\ServerRequest;
use Services\TransactionService;

class TransactionController
{
    private $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    public function create(ServerRequest $r)
    {
        $body = HttpHelpers::getBodyFromRequest($r);
        try {
            $result = $this->transactionService->createAndAssociateItems($body);
            if ($result['status'] == false) {
                return HttpHelpers::jsonResponse(400, ["error" => "Erro ao realizar a transação"]);
            } else {
                return HttpHelpers::jsonResponse(201, $this->transactionService->findWithItems($result['id']));
            }
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function findWithItems($id)
    {
        try {
            $result = $this->transactionService->findWithItems($id);
            return HttpHelpers::jsonResponse(200, $result);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function findAllWihtItems(){
        try {
            $result = $this->transactionService->findAllWihtItems();
            return HttpHelpers::jsonResponse(200, $result);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }
}
