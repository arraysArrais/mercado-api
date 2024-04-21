<?php

namespace Services;

use Models\Teste;

class HomeService{
    //model
    private $teste;

    public function __construct()
    {
        $this->teste = new Teste();
    }

    public function getAllTeste(){
        $result = $this->teste->getAll();
        return $result;
    }
}