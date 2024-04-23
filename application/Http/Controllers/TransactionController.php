<?php

namespace Http\Controllers;

use Throwable;
use Helpers\HttpHelpers;
use Laminas\Diactoros\ServerRequest;
use Services\TransactionSvc;

class TransactionController
{
    private $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionSvc();
    }

    public function create(ServerRequest $r)
    {
        $body = HttpHelpers::getBodyFromRequest($r);
        try {
            $result = $this->transactionService->createAndAssociateItems($body);

            if ($result['status'] == false) {
                return HttpHelpers::jsonResponse(400, ["error" => ""]);
            } else {
                return HttpHelpers::jsonResponse(201, $this->transactionService->findByPk($result['id']));
            }
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }
}
