<?php

namespace Http\Controllers;

use Services\ItemService;
use Throwable;
use Helpers\HttpHelpers;

class ItemController
{
    private $itemService;

    public function __construct()
    {
        $this->itemService = new ItemService();
    }

    public function findAll()
    {
        try {
            $result = $this->itemService->findAll();
            return HttpHelpers::jsonResponse(200, $result);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $result = $this->itemService->findByPk($id);
            return HttpHelpers::jsonResponse(200, $result);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function create($body)
    {
        //TODO: validar atributos
        try {
            $result = $this->itemService->create($body);

            if ($result['status'] == false) {
                return HttpHelpers::jsonResponse(400, ["error" => "Os campos price, name e category_id são obrigatórios"]);
            } else {
                return HttpHelpers::jsonResponse(201, $this->itemService->findByPk($result['id']));
            }
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function update($id, $body)
    {
        try {
            $result = $this->itemService->update($id, $body);

            if ($result == true) {
                return $this->find($id);
            } else {
                return HttpHelpers::jsonResponse(400, ["error" => "Requisição inválida."]);
            }
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->itemService->delete($id);

            if ($result == true) {
                return HttpHelpers::jsonResponse(200, ["message" => "Produto excluído com sucesso."]);
            }
            return HttpHelpers::jsonResponse(404, ["error" => "Produto não encontrado."]);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }
}
