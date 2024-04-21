<?php

namespace Http\Controllers;

use Services\CategoryService;
use Throwable;
use Helpers\HttpHelpers;
use Laminas\Diactoros\ServerRequest;

class CategoryController
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function findAll()
    {
        try {
            $result = $this->categoryService->findAll();
            return HttpHelpers::jsonResponse(200, $result);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $result = $this->categoryService->findByPk($id);
            return HttpHelpers::jsonResponse(200, $result);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function create(ServerRequest $r)
    {
        $body = HttpHelpers::getBodyFromRequest($r);
        try {
            $result = $this->categoryService->create($body);

            if ($result['status'] == false) {
                return HttpHelpers::jsonResponse(400, ["error" => "Os campos price, name e category_id são obrigatórios"]);
            } else {
                return HttpHelpers::jsonResponse(201, $this->categoryService->findByPk($result['id']));
            }
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function update($id, ServerRequest $r)
    {
        $body = HttpHelpers::getBodyFromRequest($r);
        try {
            $result = $this->categoryService->update($id, $body);

            if ($result == true) {
                return $this->find($id);
            } else {
                return HttpHelpers::jsonResponse(400, ["error" => "Requisição inválida ou registro não encontrado"]);
            }
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->categoryService->delete($id);

            if ($result == true) {
                return HttpHelpers::jsonResponse(200, ["message" => "Registro excluído com sucesso."]);
            }
            return HttpHelpers::jsonResponse(404, ["error" => "Registro não encontrado."]);
        } catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }
}
