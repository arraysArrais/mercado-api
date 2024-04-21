<?php

namespace Http\Controllers;

use Services\HomeService;
use Throwable;
use Helpers\HttpHelpers;

class HomeController
{
    private $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function home()
    {
        try {
            $result = $this->homeService->getAllTeste();
            return HttpHelpers::jsonResponse(200, $result);
        } 
        catch (Throwable $e) {
            return HttpHelpers::jsonResponse(500, $e->getMessage());
        }
    }
}
