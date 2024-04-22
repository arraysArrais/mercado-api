<?php

namespace Services;

use Models\Item;

class ItemService{

    private $item;

    public function __construct()
    {
        $this->item = new Item();
    }

    public function findAll(){
        return $this->item->getAll();
    }

    public function findByPk($id){
        return $this->item->findByPk($id);
    }

    public function create($body){
        //Checa por atributos obrigatórios
        if($body->name != null && $body->category_id != null && $body->price != null){
            return $this->item->insert($body->price, $body->name, $body->category_id, $body->description);
        }
        return false;   
    }

    public function update($id, $body){
        //Pelo menos um atributo deve ser enviado para alteração na requisição
        if($body->name == null && $body->description == null && $body->price == null && $body->category_id == null){
            return false;    
        }
        return $this->item->update($id, $body->price, $body->name, $body->description, $body->category_id);
    }

    public function delete($id){
        return $this->item->delete($id);
    }

    public function findByCodigo($codigo){
        return $this->item->findByCodigo($codigo);
    }
}