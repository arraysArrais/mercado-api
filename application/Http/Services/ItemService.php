<?php

namespace Services;

use Models\Item;

class ItemService{
    //model
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
        if($body->name != null && $body->category_id != null && $body->price != null){
            return $this->item->insert($body->price, $body->name, $body->category_id, $body->description);
        }
        return false;   
    }

    public function update($id, $body){
        if($body->name != null && $body->description != null && $body->price != null){
            return $this->item->update($id, $body->price, $body->name, $body->description, $body->category_id);
        }
        return false;
        
    }

    public function delete($id){
        return $this->item->delete($id);
    }
}